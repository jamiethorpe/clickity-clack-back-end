<?php

namespace Database\Seeders;

use App\Models\Performance;
use App\Models\Round;
use App\Models\Showdown;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ShowdownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        $completedUsers = $users->take($users->count());

        for ($i = 0; $i < $completedUsers->count() / 2; $i++) {
            $combatants = $completedUsers->take(2);

            $showdown = Showdown::factory()->completed()->create();

            $showdown->combatants()->attach($combatants->pluck('id')->toArray());

            $rounds = Round::factory()->count(config('showdown.rounds'))->create([
                'showdown_id' => $showdown->id,
            ])->each(function ($round) use ($combatants) {
                $scores = collect([
                    rand(1500, 15000),
                    rand(1500, 15000),
                ]);

                Performance::factory()->create([
                    'round_id' => $round->id,
                    'user_id' => $scores->first() > $scores->last() ? $combatants->first()->id : $combatants->last()->id,
                    'duration' => $scores->first(),
                ]);

                Performance::factory()->create([
                    'round_id' => $round->id,
                    'user_id' => $scores->first() < $scores->last() ? $combatants->first()->id : $combatants->last()->id,
                    'duration' => $scores->last(),
                ]);

                $winner = $scores->first() > $scores->last() ? $combatants->first() : $combatants->last();

                $round->user_id = $winner->id;
                $round->save();
            });

            $scores = $rounds->groupBy('user_id');

            $winner = $scores->first()->count() > $scores->last()->count() ? $scores->first()->first()->user_id : $scores->last()->first()->user_id;

            $showdown->user_id = $winner;
            $showdown->save();
        }
    }
}
