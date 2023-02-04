<?php

namespace App\Actions;

use Illuminate\Support\Arr;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateTechnique
{
    use AsAction;

    public function handle()
    {
        return "{$this->getAdjective()} {$this->getNoun()} {$this->getVerb()} {$this->getAdverb()}";
    }

    private function getAdjective()
    {
        return Arr::random([
            "angry",
            "drunken",
            "ancient",
            "fierce",
            "flying",
            "sneaky",
            "sly",
            "mystic",
            "savage",
            "mad",
            "crazy",
            "wild",
            "furious",
            "giant",
            "clever",
            "brave",
            "dark",
            "elegant",
            "flaming",
            "sleeping",
            "enlightened",
            "frozen",
            "stone",
            "winter",
            "summer",
            "subterranean",
        ]);
    }

    private function getNoun()
    {
        return Arr::random([
            "phoenix",
            "eagle",
            "wolf",
            "lion",
            "toad",
            "snake",
            "fox",
            "tortoise",
            "turtle",
            "crane",
            "crab",
            "frog",
            "knight",
            "samurai",
            "ninja",
            "warrior",
            "mage",
            "wizard",
            "warlock",
            "witch",
            "sorcerer",
            "sorceress",
            "shaman",
            "lord",
            "lady",
            "crone",
            "smith",
            "thief",
            "rogue",
            "assassin",
            "hunter",
            "ranger",
            "druid",
            "bard",
            "cleric",
            "paladin",
            "monk",
            "boar",
            "hawk",
            "bear",
            "tiger",
            "dragon",
            "king",
            "queen",
            "berserker",
            "monkey",
        ]);
    }

    private function getVerb()
    {
        return Arr::random([
            "slaps",
            "attacks",
            "laments",
            "cries",
            "screams",
            "sighs",
            "cries",
            "wanders",
            "punches",
            "charges",
            "stabs",
            "dives",
            "dodges",
            "dashes",
            "jumps",
            "lunges",
            "slices",
            "slashes",
            "leaps",
            "waits",
            "blocks",
            "parries",
            "strikes",
            "smashes",
            "bashes",
            "bites",
            "plots",
            "stalks",
            "stings",
            "plans",
            "kicks",
            "tumbles",
            "strides",
        ]);
    }

    private function getAdverb()
    {
        return Arr::random([
            "like water",
            "like smoke",
            "like a shadow",
            "like a cat",
            "like fire",
            "like ice",
            "like the wind",
            "like a storm",
            "like a hurricane",
            "like a tornado",
            "like a whirlwind",
            "silently",
            "quickly",
            "slowly",
            "swiftly",
            "elegantly",
            "aggressively",
            "boldly",
            "courageously",
            "bravely",
            "fearlessly",
            "recklessly",
            "patiently",
            "with determination",
            "with confidence",
            "with skill",
            "with precision",
            "with power",
            "with strength",
            "with speed",
            "with agility",
            "with grace",
            "with fury",
            "beautifully",
            "brutally",
            "fiercely",
            "with grace",
            "with fury",
            "with passion",
            "with love",
            "with hate",
            "with anger",
            "with joy",
            "with sadness",
            "with fear",
            "with courage",
            "with bravery",
            "with honor",
            "with pride",
            "with humility",
            "with wisdom",
            "hastily",
            "keenly",
            "softly"
        ]);
    }
}
