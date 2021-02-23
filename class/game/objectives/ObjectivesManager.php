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

    public function getObjectiveByToken(string $token) : Objective|null
    {
        //TODO
        return null;
    }

    public function achieve(string $objectiveToken, string $playerToken) : bool
    {
        //TODO
        return false;
    }

    public function isAchievedFor(string $objectiveToken, string $playerToken) : bool
    {
        //TODO
        return false;
    }

    public function getAchievementKey(string $objectiveToken, string $playerToken) : string
    {
        //TODO
        return "";
    }
}