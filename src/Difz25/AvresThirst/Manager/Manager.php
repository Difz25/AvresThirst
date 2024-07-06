<?php

declare(strict_types=1);

namespace Difz25\AvresThirst\Manager;

use Difz25\AvresThirst\AvresThirst;
use pocketmine\player\Player;
use pocketmine\event\player\PlayerJoinEvent;

interface Manager{

    /**
     * @param AvresThirst $plugin
     */
    public function __construct(AvresThirst $plugin);

    /**
     * @return void
     */
    public function open(): void;

    /**
    * @param PlayerJoinEvent $event
    * @return void
    */
    public function onPlayerJoin(PlayerJoinEvent $event): void;

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
    
    /**
    * @return int
    */
    public function getDefaultThirst(): int;
    /**
     * @param string|Player $player
     * @return float|bool
     */
    public function getMaxThirst(string|Player $player): float|bool;
    
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
    /**
     * @return void
     */
    public function save(): void;
    
    /**
     * @return void
     */
    public function close(): void;

    /**
    * @return array
    */
    public function getAll(): array;
}
