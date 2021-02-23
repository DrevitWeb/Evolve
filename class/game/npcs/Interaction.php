<?php


namespace game\npcs;


class Interaction
{
    protected int $id;
    protected string $npc;
    protected string $action;
    protected string $needs;
    protected string $token;

    public function getId(): int{return $this->id;}
    public function setId(int  $id, bool $init=false): void{if($init) $this->id = $id;}

    public function getNpc(): string{return $this->npc;}
    public function setNpc(string  $npc, bool $init=false): void
    {
        if(!$init) \basics\Database::modify("interactions", "npc", $npc, $this->token);
        $this->npc = $npc;
    }

    public function getAction(): string{return $this->action;}
    public function setAction(string  $action, bool $init=false): void
    {
        if(!$init) \basics\Database::modify("interactions", "action", $action, $this->token);
        $this->action = $action;
    }

    public function getNeeds(): string{return $this->needs;}
    public function setNeeds(string  $needs, bool $init=false): void
    {
        if(!$init) \basics\Database::modify("interactions", "needs", $needs, $this->token);
        $this->needs = $needs;
    }

    public function getToken(): string{return $this->token;}
    public function setToken(string  $token, bool $init=false): void{if($init) $this->token = $token;}
}