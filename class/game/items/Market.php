<?php


namespace game\items;


use basics\Database;
use basics\Utils;
use game\player\Player;
use game\player\PlayersManager;

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

    static function getArticleByToken(string $token) : Article|null
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
        $article = self::getArticleByToken($articleToken);
        $player = PlayersManager::getPlayerByToken($playerToken);
        if($player->getMoney() >= $article->getPrice())
        {
            $player->setMoney($player->getMoney() - $article->getPrice());
            $article->setAmount($article->getAmount()-1);
            ItemsManager::giveItem($article->getItem(), $playerToken);

            if($article->getAmount() == 0)
            {
                Database::query("DELETE FROM market WHERE token = ?", array($articleToken));
            }

            return true;
        }
        return false;
    }

    static function sellItem(string $itemToken, string $sellerToken, int $price, int $amount) : bool
    {
        if(ItemsManager::possessItem($sellerToken, $itemToken) >= $amount)
        {
            $token = Utils::generateRandomString(30);
            ItemsManager::removeItem($itemToken, $sellerToken, $amount);
            Database::query("INSERT INTO market (item, seller, price, amount, token) VALUES (?,?,?,?,?)", array(
                $itemToken,
                $sellerToken,
                $price,
                $amount,
                $token
            ));
            return true;
        }
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