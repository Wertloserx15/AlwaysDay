<?php

namespace Yanoox\Task;

use pocketmine\scheduler\Task;
use pocketmine\Server;
use Yanoox\alwaysDay;

class taskAlwaysDay extends Task {

    public $plugin;

    public function __construct(alwaysDay $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onRun(int $currentTick)
    {
        $level = [];
        $dataPath = Server::getInstance()->getDataPath();
        foreach(glob($dataPath . "worlds/*") as $world) {
            $world = str_replace($dataPath . "worlds/", "", $world);
            $level[] = $world;
        }
        foreach ($level as $l){
            $wDay = Server::getInstance()->getLevelByName($l);
            $wDay->setTime(1000);
            $wDay->stopTime();
        }
    }
}
