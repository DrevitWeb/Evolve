<?php


namespace game\items;


class Article
{
    protected int $id;
    protected string $item;
    protected string $seller;
    protected int $price;
    protected int $amount;
    protected string $token;

    public function getId(): int{return $this->id;}
    public function setId(int  $id, bool $init=false): void{if($init) $this->id = $id;}

    public function getItem(): string{return $this->item;}
    public function setItem(string  $item, bool $init=false): void{if($init) $this->item = $item;}

    public function getSeller(): string{return $this->seller;}
    public function setSeller(string  $seller, bool $init=false): void{if($init) $this->seller = $seller;}

    public function getAmount(): int{return $this->amount;}
    public function setAmount(int  $amount, bool $init=false): void
    {
        if(!$init) \basics\Database::modify("market", "amount", $amount, $this->token);
        $this->amount = $amount;
    }

    public function getPrice(): int{return $this->price;}
    public function setPrice(int  $price, bool $init=false): void
    {
        if(!$init) \basics\Database::modify("market", "price", $price, $this->token);
        $this->price = $price;
    }

    public function getToken(): string{return $this->token;}
    public function setToken(string  $token, bool $init=false): void{if($init) $this->token = $token;}
    
    
}