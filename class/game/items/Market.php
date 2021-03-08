<?php


namespace game\items;


use basics\Database;
use basics\Utils;
use game\player\Player;

class Market
{
    static function isInMarket(string $itemToken) : bool
    {
        if(Database::query("SELECT * FROM market WHERE item=?", array($itemToken))->rowCount() != 0) return true;
        return false;
    }

    static function getArticlesForItem(string $itemToken) : array|null
    {
        if(self::isInMarket($itemToken))
        {
            $items = Database::query("SELECT * FROM market WHERE item = ?", array($itemToken))->fetchAll();
            $items = Utils::setObjects($items, "game\items\Article");

            return $items;
        }
        return null;
    }

    static function getArticleFromToken(string $token) : Article|null
    {
        $article = Database::query("SELECT * FROM market WHERE token = ?", array($token))->fetch();
        if($article)
        {
            return Utils::setObject($article, "game\items\Article");
        }
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

    static function getArticles() : array
    {
        $items = Database::query("SELECT * FROM market");
        $items = Utils::setObjects($items, "game\items\Article");

        return $items;
    }

    static function getArticlesOffset(int $offset, int $limit) : array
    {
        $items = Database::query("SELECT * FROM market LIMIT ".$offset.", ".$limit);
        $items = Utils::setObjects($items, "game\items\Article");

        return $items;
    }
}