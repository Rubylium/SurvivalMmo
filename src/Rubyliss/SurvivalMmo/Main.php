<?php

declare(strict_types=1);

namespace Rubyliss\SurvivalMmo;

use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerJoinEvent;

use pocketmine\utils\Config;

class Main extends PluginBase {

	public function onEnable() : void{
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        @mkdir($this->getDataFolder()."resources/");
        @mkdir($this->getDataFolder()."resources/LevelData/");
        @mkdir($this->getDataFolder()."resources/LevelData/MineurLevel/");
        @mkdir($this->getDataFolder()."resources/LevelData/LumberjackLevel/");
        $this->getLogger()->info("§eSurvivalMmo Main : §aON!");
        $this->getServer()->getPluginManager()->registerEvents(new MinerJob($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new LumberjackJob($this), $this);
        $this->getServer()->getCommandMap()->register("level", new LevelCommand($this, "level"));

	}

    public function OnJoin(PlayerJoinEvent $event) {
        $name = $event->getPlayer()->getName();
        $this->getLogger()->info("§eSurvivalMmo: §aOnJoin");

        if(!(file_exists($this->getDataFolder()."resources/LevelData/LumberjackLevel/".strtolower($name).".yml"))){
            $configLumberjack = new Config($this->getDataFolder() . "resources/LevelData/LumberjackLevel/" . strtolower($name) . ".yml", Config::YAML);
            $configLumberjack->set('LumberjackXP', 1);
            $configLumberjack->set('LumberjackLevel', 1);
            $configLumberjack->save();
            $this->getLogger()->info("§eSurvivalMmo: §aFile lumberjack created!");
        }
        if(!(file_exists($this->getDataFolder()."resources/LevelData/MinerLevel/".strtolower($name).".yml"))){
            $configMiner = new Config($this->getDataFolder() . "resources/LevelData/MinerLevel/" . strtolower($name) . ".yml", Config::YAML);
            $configMiner->set('MinerXP', 1);
            $configMiner->set('MinerLevel', 1);
            $configMiner->save();
            $this->getLogger()->info("§eSurvivalMmo: §aFile miner created!");
        }


    }


	public function onDisable() : void{
		$this->getLogger()->info("§eSurvivalMmo Main : §aOFF!");
	}
}
