<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowdownReadyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'rounds'=> $this->rounds->map(function ($round) {
                return [
                    'id' => $round->id,
                    'technique' => $round->technique,
                ];
            })->toArray(),
            'combatants' => $this->combatants->map(function ($combatant) {
                return [
                    'id' => $combatant->id,
                ];
            })->toArray(),
        ];
    }
}
