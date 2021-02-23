<?php


namespace game\items;


class ItemsManager
{
    public static function createNewItem(string $name, string $description, string $image) : Item
    {
        //TODO
        return new Item();
    }

    public static function getItemByToken(string $token) : Item|null
    {
        //TODO
        return null;
    }

    public static function giveItem(string $itemToken, string $playerToken) : void
    {
        //TODO
    }
}