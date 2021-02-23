<?php


namespace game\npcs;


class NPCsManager
{
    public static function createNewNPC(string $name, string $description, string $image, int $type, string $location) : NPC
    {
        //TODO
        return new NPC();
    }

    public static function getNPCByToken(string $token) : NPC|null
    {
        //TODO
        return null;
    }

    public static function listNPCByLocation(string $location) : array
    {
        //TODO
        return array();
    }

    public static function getInteractions(string $npcToken) : array
    {
        //TODO
        return array();
    }

    public static function setInteracted(string $interactionToken, string $playerToken)
    {
        //TODO
    }

    public static function hasInteracted(string $interactionToken, string $playerToken) : bool
    {
        //TODO
        return false;
    }
}