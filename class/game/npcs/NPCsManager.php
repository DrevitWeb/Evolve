<?php


namespace game\npcs;


use basics\Database;
use basics\Utils;
use game\player\PlayersManager;

class NPCsManager
{
    public static function createNewNPC(string $name, string $description, string $image, int $type, string $location) : NPC
    {
        $token = Utils::generateRandomString(30);
        Database::query("INSERT INTO npcs (name, description, image, type, location, token) VALUES (?,?,?,?,?,?)", array(
            $name,
            $description,
            $image,
            $type,
            $location,
            $token
        ));
        return self::getNPCByToken($token);
    }

    public static function getNPCByToken(string $token) : NPC|null
    {
        $npc = Database::query("SELECT * FROM npcs WHERE token = ?", array($token))->fetch();
        if($npc)
        {
            return Utils::setObject($npc, "games\\npcs\NPC");
        }
        return null;
    }

    public static function listNPCByLocation(string $location) : array
    {
        $npcs = Database::query("SELECT * FROM npcs WHERE location = ?", array($location))->fetchAll();
        return Utils::setObjects($npcs, "games\\npcs\NPC");
    }

    public static function getInteractions(string $npcToken) : array
    {
        $interactions = Database::query("SELECT * FROM interactions WHERE NPC = ?", array($npcToken))->fetchAll();
        return Utils::setObjects($interactions, "games\\npcs\Interaction");
    }

    public static function getInteractionByToken(string $token) : Interaction
    {
        $interaction = Database::query("SELECT * FROM interactions WHERE token = ?", array($token))->fetch();
        return Utils::setObject($interaction, "games\\npcs\Interaction");
    }

    public static function setInteracted(string $interactionToken, string $playerToken) : bool
    {
        if(PlayersManager::getPlayerByToken($playerToken))
        {
            if(self::getInteractionByToken($interactionToken))
            {
                if(!self::hasInteracted($interactionToken, $playerToken))
                {
                    Database::query("INSERT INTO interacted (player, interaction) VALUES (?,?)", array(
                        $playerToken,
                        $interactionToken
                    ));
                    return true;
                }
            }
        }
        return false;
    }

    public static function hasInteracted(string $interactionToken, string $playerToken) : bool
    {
        return Database::query("SELECT * FROM interacted WHERE player = ? AND interaction = ?", array(
            $playerToken,
            $interactionToken
        ))->rowCount() != 0;
    }

    public function getActionByToken(string $token) : Action|null
    {
        $action = Database::query("SELECT * FROM actions WHERE token = ?", array($token))->fetch();
        return Utils::setObject($action, "game\\npcs\Action");
    }

    public static function launchInteraction(string $interactionToken, string $playerToken) : bool
    {
        //TODO
        return false;
    }
}