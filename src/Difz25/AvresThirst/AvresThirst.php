<?php

namespace Difz25\AvresThirst;

use Difz25\AvresThirst\Manager\ThirstManager;
use JsonException;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class AvresThirst extends PluginBase {

    protected ThirstManager $mgr;
    protected Config $config;

    /**
     * @throws JsonException
     */
    public function onEnable(): void {
        $this->mgr = new ThirstManager($this);
        $this->mgr->save();
    }

    /**
     * @throws JsonException
     */
    protected function onDisable(): void {
        $this->mgr->close();
    }

    public function defaultThirst(): int {
        return $this->mgr->getDefaultThirst();
    }

    public function getAllThirst(): array {
        return $this->mgr->getAll();
    }
    
    public function getThirst($player): float|bool
    {
        return $this->mgr->getThirst($player);
    }
    
    public function setThirst($player, $amount): bool {
        return $this->mgr->setThirst($player, $amount);
    }
    
    public function reduceThirst($player, $amount): bool {
        return $this->mgr->reduceThirst($player, $amount);
    }
    
    public function addThirst($player, $amount): bool {
        return $this->mgr->addThirst($player, $amount);
    }
}