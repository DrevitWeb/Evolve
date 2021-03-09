<?php

namespace game\objectives;

use basics\Database;
use basics\Utils;
use game\items\Item;
use game\player\PlayersManager;

class ObjectivesManager
{
    public function createNewObjective(string $name, string $description, string $location, Item|int $reward, string|null $needs) : Objective|null
    {
        $token = Utils::generateRandomString(30);
        Database::query("INSERT INTO objectives (name, description, location, reward, needs, token) VALUES (?,?,?,?,?,?)", array(
            $name,
            $description,
            $location,
            $reward,
            $needs,
            $token
        ));
        return Utils::setObject(Database::query("SELECT * FROM objectives WHERE token = ?", array($token))->fetch(), "game\objectives\Objective");
    }

    public function getObjectiveByToken(string $token) : Objective|null
    {
        return Utils::setObject(Database::query("SELECT * FROM objectives WHERE token = ?", array($token))->fetch(), "game\objectives\Objective");
    }

    public function achieve(string $objectiveToken, string $playerToken) : bool
    {
        if(self::getObjectiveByToken($objectiveToken) != null && PlayersManager::getPlayerByToken($playerToken) != null)
        {
            if (!self::isAchievedFor($objectiveToken, $playerToken))
            {
                Database::query("UPDATE achievements SET state = 1 WHERE player = ? AND objective = ?", array(
                    $objectiveToken,
                    $playerToken
                ));
                return true;
            }
        }
        return false;
    }

    public function isAchievedFor(string $objectiveToken, string $playerToken) : bool
    {
        $achievement = Database::query("SELECT * FROM achievements WHERE player = ? AND objective = ?")->fetch();

        return $achievement->state == 1;
    }

    public function getAchievementIdentifier(string $objectiveToken, string $playerToken) : string
    {
        //TODO
        return "";
    }
}