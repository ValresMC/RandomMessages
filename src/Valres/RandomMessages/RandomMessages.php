<?php

namespace Valres\RandomMessages;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\Config;

class RandomMessages extends PluginBase
{
    protected function onEnable(): void
    {
        $this->getLogger()->info("by Valres est lancé !");
        $this->saveDefaultConfig();
        $this->getScheduler()->scheduleRepeatingTask(new ClosureTask(function (){
            $messages = $this->config()->get("messages");
            $this->getServer()->broadcastMessage($messages[array_rand($messages)]);
        }), $this->config()->get("time")*20);
    }

    public function config(): Config
    {
        return new Config($this->getDataFolder()."config.yml", Config::YAML);
    }
}
