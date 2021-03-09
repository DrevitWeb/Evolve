<?php


namespace game\player;


use basics\Database;

class Ranking
{
    static function getRanking() : array
    {
        return Database::query("SELECT * FROM ranking")->fetchAll();
    }

    static function addPlayer(string $type, string $playerToken) : int
    {
        //TODO
        return 0;
    }
}