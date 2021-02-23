<?php


namespace game\npcs;


class NPC
{
    protected int $id;
    protected string $name;
    protected string $description;
    protected string $image;
    protected int $type;
    protected string $location;
    protected string $token;

    public function getId(): int {return $this->id;}
    public function setId(int  $id, bool $init=false): void{if($init) $this->id = $id;}
    
    public function getName(): string {return $this->name;}
    public function setName(string  $name, bool $init=false): void
    {
        if(!$init) \basics\Database::modify("npcs", "name", $name, $this->token);
        $this->name = $name;
    }
    
    public function getDescription(): string {return $this->description;}
    public function setDescription(string  $description, bool $init=false): void
    {
        if(!$init) \basics\Database::modify("npcs", "description", $description, $this->token);
        $this->description = $description;
    }
    
    public function getImage(): string {return $this->image;}
    public function setImage(string  $image, bool $init=false): void
    {
        if(!$init) \basics\Database::modify("npcs", "image", $image, $this->token);
        $this->image = $image;
    }
    
    public function getType(): int {return $this->type;}
    public function setType(int  $type, bool $init=false): void
    {
        if(!$init) \basics\Database::modify("npcs", "type", $type, $this->token);
        $this->type = $type;
    }
    
    public function getLocation(): string {return $this->location;}
    public function setLocation(string  $location, bool $init=false): void
    {
        if(!$init) \basics\Database::modify("npcs", "location", $location, $this->token);
        $this->location = $location;
    }
    
    public function getToken(): string {return $this->token;}
    public function setToken(string  $token, bool $init=false): void{if($init) $this->token = $token;}
}