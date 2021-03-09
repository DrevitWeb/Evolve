<?php


namespace game\items;


use basics\Database;
use basics\Utils;
use game\player\PlayersManager;

class ItemsManager
{
    public static function createNewItem(string $name, string $description, string $image) : Item|null
    {
        $token = Utils::generateRandomString(30);
        Database::query("INSERT INTO items (name, description, image, token) VALUES (?,?,?,?)", array(
            $name,
            $description,
            $image,
            $token
        ));
        return self::getItemByToken($token);
    }

    public static function getItemByToken(string $token) : Item|null
    {
        $itemArray = Database::query("SELECT * FROM items WHERE token = ?", array($token))->fetch();
        return Utils::setObject($itemArray, "game\items\Item");
    }

    public static function possessItem(string $playerToken, string $itemToken) : int
    {
        $inventory = Database::query("SELECT * FROM inventories WHERE player=? AND item=?", array(
            $playerToken,
            $itemToken
        ))->fetch();

        if(!$inventory) return $inventory->amount;
        return 0;
    }

    public static function giveItem(string $itemToken, string $playerToken) : bool
    {
        $item = self::getItemByToken($itemToken);
        if($item)
        {
            $player = PlayersManager::getPlayerByToken($playerToken);
            if($player)
            {
                if(self::possessItem($playerToken, $item) != 0)
                {
                    Database::query("UPDATE inventories SET amount = amount + 1 WHERE player = ? AND item = ?", array(
                        $playerToken,
                        $itemToken
                    ));
                }
                else
                {
                    Database::query("INSERT INTO inventories (player, item, amount) VALUES (?,?,?)", array(
                        $playerToken,
                        $itemToken,
                        1
                    ));
                }
                return true;
            }
            return false;
        }
        return false;
    }

    public static function removeItem(string $itemToken, string $playerToken, int $amount) : bool
    {
        $item = self::getItemByToken($itemToken);
        if($item)
        {
            $player = PlayersManager::getPlayerByToken($playerToken);
            if($player)
            {
                if(ItemsManager::possessItem($playerToken, $itemToken) > $amount)
                {
                    Database::query("UPDATE inventories SET amount = amount - ? WHERE item = ? AND player = ?", array(
                        $amount,
                        $itemToken,
                        $playerToken
                    ));
                    return true;
                }
                else if(ItemsManager::possessItem($playerToken, $itemToken) == $amount)
                {
                    Database::query("DELETE FROM inventories WHERE item = ? AND player = ?", array(
                        $itemToken,
                        $playerToken
                    ));
                    return true;
                }
                return false;
            }
            return false;
        }
        return false;
    }
}