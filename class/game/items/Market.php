<?php


namespace game\items;


use game\player\Player;

class Market
{
    static function isInMarket(string $itemToken) : bool
    {
        //TODO
        return false;
    }

    static function getPrice(string $articleToken) : int
    {
        //TODO
        return -1;
    }

    static function getAmount(string $articleToken) : int
    {
        //TODO
        return -1;
    }

    static function getSeller(string $articleToken) : Player|null
    {
        //TODO
        return null;
    }

    static function sellArticleToPlayer(string $articleToken, string $playerToken) : bool
    {
        //TODO
        return false;
    }

    static function sellItem(string $itemToken, string $sellerToken, int $price) : bool
    {
        //TODO
        return false;
    }

    static function getItem(string $articleToken) : Item|null
    {
        //TODO
        return null;
    }

    static function getArticles() : array
    {
        //TODO
        return array();
    }
}