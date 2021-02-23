<?php

namespace game\objectives;

class Objective
{
    protected int $id;
    protected string $name;
    protected string $description;
    protected string $location;
    protected string $reward;
    protected string $needs;
    protected string $token;
    
    public function getId(): int {return $this->id;}
    public function setId(int  $id, bool $init=false): void
    {
        if(!$init) \basics\Database::modify("objectives", "id", $id, $this->token);
        $this->id = $id;
    }

    public function getName(): string {return $this->name;}
    public function setName(string  $name, bool $init=false): void
    {
        if(!$init) \basics\Database::modify("objectives", "name", $name, $this->token);
        $this->name = $name;
    }

    public function getDescription(): string {return $this->description;}
    public function setDescription(string  $description, bool $init=false): void
    {
        if(!$init) \basics\Database::modify("objectives", "description", $description, $this->token);
        $this->description = $description;
    }

    public function getLocation(): string {return $this->location;}
    public function setLocation(string  $location, bool $init=false): void
    {
        if(!$init) \basics\Database::modify("objectives", "location", $location, $this->token);
        $this->location = $location;
    }

    public function getReward(): string {return $this->reward;}
    public function setReward(string  $reward, bool $init=false): void
    {
        if(!$init) \basics\Database::modify("objectives", "reward", $reward, $this->token);
        $this->reward = $reward;
    }

    public function getNeeds(): string {return $this->needs;}
    public function setNeeds(string  $needs, bool $init=false): void
    {
        if(!$init) \basics\Database::modify("objectives", "needs", $needs, $this->token);
        $this->needs = $needs;
    }

    public function getToken(): string {return $this->token;}
    public function setToken(string  $token, bool $init=false): void
    {
        if(!$init) \basics\Database::modify("objectives", "token", $token, $this->token);
        $this->token = $token;
    }


}