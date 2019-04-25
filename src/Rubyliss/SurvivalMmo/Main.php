<?php

declare(strict_types=1);

namespace Rubyliss\SurvivalMmo;

use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;

class Main extends PluginBase {

	public function onEnable() : void{
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        @mkdir($this->getDataFolder()."resources/");
        @mkdir($this->getDataFolder()."resources/LevelData/");
        @mkdir($this->getDataFolder()."resources/LevelData/MineurLevel/");
        $this->getLogger()->info("§eSurvivalMmo Main : §aON!");
        $this->getServer()->getPluginManager()->registerEvents(new MinerJob($this), $this);

	}


	public function onDisable() : void{
		$this->getLogger()->info("§eSurvivalMmo Main : §aOFF!");
	}
}
