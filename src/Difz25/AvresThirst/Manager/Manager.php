<?php

namespace Difz25\AvresThirst\Manager;

use Difz25\AvresThirst\AvresThirst;
use pocketmine\player\Player;
use pocketmine\event\player\PlayerJoinEvent;

interface Manager{
    
    public function __construct(AvresThirst $plugin);

    public function open(): void;

    /**
    * @param PlayerJoinEvent $event
    * @return void
    */
    public function onPlayerJoin(PlayerJoinEvent $event): void;

    /**
    * @param string $player
    * @return array
    */
    public function defaultThirst($amount = 100): array;

    /**
    * @param string $player
    * @return float|bool
    */
    public function getThirst(string $player): float|bool;

    /**
    * @param string|Player $player
    * @param float $amount
    * @return bool
    */
    public function setThirst(Player|string $player, float $amount): bool;

    /**
    * @param string|Player $player
    * @param float $amount
    * @return bool
    */
    public function addThirst(Player|string $player, float $amount): bool;

    /**
    * @param string|Player $player
    * @param float $amount
    * @return bool
    */
    public function reduceThirst(Player|string $player, float $amount): bool;

    public function save(): void;
    
    public function close(): void;

    /**
    * @return array
    */
    public function getAll(): array;
}
