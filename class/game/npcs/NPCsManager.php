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
}