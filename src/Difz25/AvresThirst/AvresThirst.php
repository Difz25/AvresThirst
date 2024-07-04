<?php

namespace Difz25\AvresThirst;

use JsonException;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use Difz25\AvresThirst\Manager\ThirstManager;
use pocketmine\utils\Config;

class AvresThirst extends PluginBase {

    protected ThirstManager $mgr;
    protected Config $config;

    /**
     * @throws JsonException
     */
    public function onEnable(): void {
        $this->mgr = new ThirstManager($this);
        $this->config = new Config($this->getDataFolder() . "thirst.yml", Config::YAML, ["version" => 2, "thirst" => [],]);
        $this->mgr->save();
    }
    protected function onDisable(): void {
        $this->mgr->close();
    }

    public function defaultThirst($amount = 100): array {
        return $this->mgr-?defaultThirst();
    }

    public function getAllThirst(): array {
        return $this->mgr->getAll();
    }
    
    public function getThirst($player) {
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
    
    public function getThirstData(): Config {
        return $this->config;
    }
    
    public function getConfigData(): Config {
        return $this->config;
    }
    
    public function isPlayer($player): void {
        if($player instanceof Player);
    }
}