<?php

namespace Yanoox;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use Yanoox\Command\commandUpdate;

class alwaysDay extends PluginBase{

    public function onEnable()
    {
        self::loadLevels();
        Server::getInstance()->getCommandMap()->register("alwaysday", new commandUpdate($this));
        $this->getLogger()->info(TextFormat::GOLD . "Plugin created by Yanoox");
    }
    public static function loadLevels(){
        $dataPath = Server::getInstance()->getDataPath();
        foreach(glob($dataPath . "worlds/*") as $world) {
            $world = str_replace($dataPath . "worlds/", "", $world);
            if(!Server::getInstance()->isLevelLoaded($world)){
                Server::getInstance()->loadLevel($world);
            }
        }
    }
}
