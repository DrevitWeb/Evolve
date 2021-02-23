<?php

namespace game\objectives;

use game\items\Item;

class ObjectivesManager
{
    public function createNewObjective(string $name, string $description, string $location, Item|int $reward, string|null $needs) : Objective|null
    {
        //TODO
        return null;
    }
}