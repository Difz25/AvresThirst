<?php

namespace Difz25\AvresThirst\Manager;

use Difz25\AvresThirst\AvresThirst;

use JsonException;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\player\Player;
use pocketmine\utils\Config;

class ThirstManager implements Manager{
    
    protected Avresthirst $plugin;
    protected array $thirstData = [];
    private Config $config;

    public function __construct(AvresThirst $plugin){
        $this->plugin = $plugin;
    }
    
    public function open(): void {
        $this->config = new Config($this->plugin->getDataFolder() . "thirst.yml", Config::YAML, ["version" => 1, "thirst" => [], "maxThirst" => []]);
		$this->thirstData = $this->config->getAll();
    }

    public function onPlayerJoin(PlayerJoinEvent $event): void {
        $player = $event->getPlayer();
        $player = $player->getName();
        $this->thirstData["thirst"][$player] = $this->getDefaultThirst();
    }
    
    public function getThirst(string|Player $player): float|bool {
		$player = $player->getName();
        $player = strtolower($player);

        if(isset($this->thirstData["thirst"][$player])){
            return $this->thirstData["thirst"][$player];
        }
        
        return false;
    }

    public function getDefaultThirst(): int {
        return 100;
    }
    
    public function getMaxThirst(string|Player $player): float|bool {
        $player = $player->getName();
		$player = strtolower($player);

        if(isset($this->thirst["maxThirst"][$player])){
            return $this->thirstData["maxThirst"][$player];
        }
        
        return false;
    }
    
    public function setThirst($player, $amount): bool
    {
		$player = $player->getName();
		$player = strtolower($player);

        if(isset($this->thirst["thirst"][$player])){
            if($this->thirstData["thirst"][$player] < 100){
                $this->thirst["thirst"][$player] = $amount;
                $this->thirst["thirst"][$player] = round($this->thirst["thirst"][$player], 2);
                return true;
            }
        }
		return false;
    }
    
    public function reduceThirst($player, $amount): bool
    {
        if($player instanceof Player){
            $player = $player->getName();
        }
        $player = strtolower($player);

        if(isset($this->thirst["thirst"][$player])){
            if($this->thirstData["thirst"][$player] < 100){
                $this->thirst["thirst"][$player] -= $amount;
                $this->thirst["thirst"][$player] = round($this->thirst["thirst"][$player], 2);
                return true;
            }
        }
        return false;
    }
    
    public function addThirst($player, $amount): bool
    {
		$player = $player->getName();
		$player = strtolower($player);

        if(isset($this->thirst["thirst"][$player])){
            if($this->thirstData["thirst"][$player] < 100){
                $this->thirst["thirst"][$player] += $amount;
                $this->thirst["thirst"][$player] = round($this->thirst["thirst"][$player], 2);
                return true;
            }
        }
        return false;
    }

    /**
     * @throws JsonException
     */
    public function save(): void {
		$this->config->setAll($this->thirstData);
	    $this->config->save();
	}

    /**
     * @throws JsonException
     */
    public function close(): void {
		$this->save();
	}

    /**
     * @return array
     */
    public function getAll(): array {
        return $this->thirstData["thirst"] ?? [];
    }
}