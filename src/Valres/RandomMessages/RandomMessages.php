<?php

namespace Valres\RandomMessages;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\Config;

class RandomMessages extends PluginBase
{
    private array $messages = [];
    private int $timer = 0;

    protected function onEnable(): void {
        $this->getLogger()->info("by Valres est lancé !");
        $this->saveDefaultConfig();

        $this->messages = $this->getConfig()->get("messages");
        $this->timer = $this->getConfig()->get("time");

        $this->getScheduler()->scheduleRepeatingTask(new ClosureTask(function (): void {
            $this->getServer()->broadcastMessage($this->messages[array_rand($this->messages)]);
        }), $this->timer * 20);
    }
}
