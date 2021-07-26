<?php

namespace Yanoox\Command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use Yanoox\alwaysDay;
use Yanoox\Task\taskAlwaysDay;

class commandUpdate extends Command{

    public $plugin;


    public function __construct(alwaysDay $plugin)
    {
        parent::__construct("alwaysday");
        $this->setDescription("Active/désactive le jour éternel");
        $this->setPermission("alwaysday.command");
        $this->setAliases(["ad", "always", "day"]);
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!isset($args[0])){
            $sender->sendMessage("/ad <on/off>");
        }
        elseif ($args[0] === "on"){
            $this->plugin->getScheduler()->scheduleRepeatingTask(new taskAlwaysDay($this->plugin), 1);
            $sender->sendMessage("[AlwaysDay] - " . TextFormat::GREEN . "Jour éternel activé.");
        }
        elseif ($args[0] === "off"){
            $task = $this->plugin->getScheduler()->scheduleRepeatingTask(new taskAlwaysDay($this->plugin), 1);
            $this->plugin->getScheduler()->cancelAllTasks();
            $sender->sendMessage("[AlwaysDay] - " . TextFormat::RED .  "Jour éternel désactivé.");
        }
        else{
            $sender->sendMessage("/ad <on/off>");
        }
    }
}
