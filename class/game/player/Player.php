<?php

namespace game\player;

use basics\Database;
use game\items\ItemsManager;

class Player
{
    protected int $id;
    protected string $name;
    protected string $surname;
    protected string $location;
    protected int $money;
    protected int $state;
    protected int $trapped;
    protected int $defended;
    protected string $user;
    protected int $last_play;
    protected string $origin;
    protected string $token;


    public function getId(): int{return $this->id;}
    public function setId(int $id, bool $init=false): void{ if($init) $this->id = $id;}

    public function getName(): string{return $this->name;}
    public function setName(string  $name, bool $init=false): void
    {
        if(!$init) Database::modify("players", "name", $name, $this->token);
        $this->name = $name;
    }

    public function getSurname(): string{return $this->surname;}
    public function setSurname(string  $surname, bool $init=false): void
    {
        if(!$init) Database::modify("players", "surname", $surname, $this->token);
        $this->surname = $surname;
    }

    public function getLocation(): string{return $this->location;}
    public function setLocation(string  $location, bool $init=false): void
    {
        if(!$init) Database::modify("players", "location", $location, $this->token);
        $this->location = $location;
    }

    public function getMoney(): int{return $this->money;}
    public function setMoney(int  $money, bool $init=false): void
    {
        if(!$init) Database::modify("players", "money", $money, $this->token);
        $this->money = $money;
    }

    public function getState(): int{return $this->state;}
    public function setState(int  $state, bool $init=false): void
    {
        if(!$init) Database::modify("players", "state", $state, $this->token);
        $this->state = $state;
    }

    public function getTrapped(): int{return $this->trapped;}
    public function setTrapped(int  $trapped, bool $init=false): void
    {
        if(!$init) Database::modify("players", "trapped", $trapped, $this->token);
        $this->trapped = $trapped;
    }

    public function getDefended(): int{return $this->defended;}
    public function setDefended(int  $defended, bool $init=false): void
    {
        if(!$init) Database::modify("players", "defended", $defended, $this->token);
        $this->defended = $defended;
    }

    public function getUser(): string{return $this->user;}
    public function setUser(string  $user, bool $init=false): void
    {
        if(!$init) Database::modify("players", "user", $user, $this->token);
        $this->user = $user;
    }

    public function getLastPlay(): int{return $this->last_play;}
    public function setLastPlay(int  $last_play, bool $init=false): void
    {
        if(!$init) Database::modify("players", "last_play", $last_play, $this->token);
        $this->last_play = $last_play;
    }

    public function getOrigin(): string{return $this->from;}
    public function setOrigin(string  $origin, bool $init=false): void
    {
        if(!$init) Database::modify("players", "origin", $origin, $this->token);
        $this->origin = $origin;
    }

    public function getToken(): string{return $this->token;}
    public function setToken(string $token, bool $init=false): void{if($init) $this->token = $token;}

    public function getInventory() : array
    {
        $inv = Database::query("SELECT * FROM inventories WHERE player=?", array($this->token))->fetchAll();
        foreach ($inv as &$item)
        {
            $item->item = ItemsManager::getItemByToken($item->item);
        }

        return $inv;
    }
}