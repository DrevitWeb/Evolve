<?php


namespace game\npcs;

//TODO
class Action
{
    protected int $id;
    protected string $description;
    protected string $image;
    protected string $objective;
    protected string $next;
    protected string $token;

    public function getId(): int {return $this->id;}
    public function setId(int  $id, bool $init=false): void{if($init) $this->id = $id;}

    public function getDescription(): string {return $this->description;}
    public function setDescription(string  $description, bool $init=false): void
    {
        if(!$init) \basics\Database::modify("actions", "description", $description, $this->token);
        $this->description = $description;
    }

    public function getImage(): string {return $this->image;}
    public function setImage(string  $image, bool $init=false): void
    {
        if(!$init) \basics\Database::modify("actions", "image", $image, $this->token);
        $this->image = $image;
    }

    public function getObjective(): string {return $this->objective;}
    public function setObjective(string  $objective, bool $init=false): void
    {
        if(!$init) \basics\Database::modify("actions", "objective", $objective, $this->token);
        $this->objective = $objective;
    }

    public function getNext(): string {return $this->next;}
    public function setNext(string  $next, bool $init=false): void
    {
        if(!$init) \basics\Database::modify("actions", "next", $next, $this->token);
        $this->next = $next;
    }

    public function getToken(): string {return $this->token;}
    public function setToken(string  $token, bool $init=false): void{if($init) $this->token = $token;}
}