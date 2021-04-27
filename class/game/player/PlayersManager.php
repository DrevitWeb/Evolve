<?php

namespace game\player;


use basics\Database;
use basics\Utils;

class PlayersManager
{
    static function newPlayer(string $name, string $surname, string $from, string $userToken) : Player
    {
        $token = Utils::generateRandomString(30);
        $location = "ORIGIN"; //TODO
        Database::query("INSERT INTO players (name, surname, location, money, state, trapped, defended, user, token, origin) VALUES (?,?,?,?,?,?,?,?,?,?)",array(
            $name,
            $surname,
            $location,
            0, //TODO
            PlayerState::$PLAYING,
            0,
            0,
            $userToken,
            $token,
            $from
        ));

        return Utils::setObject(Database::query("SELECT * FROM players WHERE token = ?", array($token))->fetch(), "game\player\Player");
    }

    static function getPlayerByToken(string $token) : Player|null
    {
        return Utils::setObject(Database::query("SELECT * FROM players WHERE token = ?", array($token))->fetch(), "game\player\Player");
    }

    static function getPlayers() : array
    {
        return Utils::setObjects(Database::query("SELECT * FROM players")->fetchAll(), "game\player\Players");
    }


}