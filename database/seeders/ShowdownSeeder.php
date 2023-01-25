<?php

namespace Database\Seeders;

use App\Actions\CompleteShowdown;
use App\Actions\DetermineIfShowdownHasWinner;
use App\Models\Performance;
use App\Models\Round;
use App\Models\Showdown;
use App\Models\User;
use Illuminate\Database\Seeder;

class ShowdownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($showdownCount = 20)
    {
        $users = User::all();

        $showdowns = Showdown::factory()->count($showdownCount)->create();

        $showdowns->each(function ($showdown) use ($users) {
            $combatants = $users->random(2);
            $showdown->combatants()->attach($combatants->pluck('id')->toArray());

            $rounds = Round::factory()->count(config('showdown.rounds'))->create([
                'showdown_id' => $showdown->id,
            ]);

            for ($i = 0; $i < config('showdown.rounds'); $i++) {
                $durations = collect([
                    rand(1500, 15000),
                    rand(1500, 15000),
                ]);

                Performance::factory()->create([
                    'round_id' => $rounds[$i]->id,
                    'user_id' => $durations->first() < $durations->last() ? $combatants->first()->id : $combatants->last()->id,
                    'duration' => $durations->first(),
                ]);

                Performance::factory()->create([
                    'round_id' => $rounds[$i]->id,
                    'user_id' => $durations->first() > $durations->last() ? $combatants->first()->id : $combatants->last()->id,
                    'duration' => $durations->last(),
                ]);

                $roundWinner = $durations->first() < $durations->last() ? $combatants->first() : $combatants->last();

                $rounds[$i]->user_id = $roundWinner->id;
                $rounds[$i]->save();

                if ($showdownWinner = DetermineIfShowdownHasWinner::run($showdown->refresh())) {
                    CompleteShowdown::run($showdown, $showdownWinner);
                    break;
                }
            }
        });
    }
}
