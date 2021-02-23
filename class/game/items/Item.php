<?php

namespace game\items;

use basics\Database;

class Item
{
    protected int $id;
    protected string $name;
    protected string $description;
    protected string $image;
    protected string $token;

    public function getId(): int{return $this->id;}
    public function setId(int  $id, bool $init=false): void{if($init) $this->id = $id;}

    public function getName(): string{return $this->name;}
    public function setName(string  $name, bool $init=false): void
    {
        if(!$init) Database::modify("items", "name", $name, $this->token);
        $this->name = $name;
    }

    public function getDescription(): string{return $this->description;}
    public function setDescription(string  $description, bool $init=false): void
    {
        if(!$init) Database::modify("items", "description", $description, $this->token);
        $this->description = $description;
    }

    public function getImage(): string{return $this->image;}
    public function setImage(string  $image, bool $init=false): void
    {
        if(!$init) \basics\Database::modify("items", "image", $image, $this->token);
        $this->image = $image;
    }

    public function getToken(): string{return $this->token;}
    public function setToken(string  $token, bool $init=false): void{if($init) $this->token = $token;}


}