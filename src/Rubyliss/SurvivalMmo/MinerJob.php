<?php


namespace Rubyliss\SurvivalMmo;

use Rubyliss\SurvivalMmo\Main;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\block\BlockBreakEvent;

use pocketmine\Server;

use pocketmine\utils\Config;

class MinerJob implements Listener {

    private $main;

    public function __construct(Main $main){
        $this->main = $main;
    }


        public function onBreak(BlockBreakEvent $event){
        $config = new Config($this->main->getDataFolder() . "resources/LevelData/MinerLevel/" . strtolower($event->getPlayer()->getName()) . ".yml", Config::YAML);
        $config2 = new Config($this->main->getDataFolder() . "config.yml", Config::YAML);

        $player = $event->getPlayer();
        $name = $player->getName();

        $blocks = ["1", "1:1", "1:2", "1:3", "1:4", "1:5", "1:6", "4", "14", "15", "16", "13", "73", "74"];
        if(in_array($event->getBlock()->getId(), $blocks)){
            // Check si c'est un nouveau joueurs, création du fichier level mineur
            if($config->get('MinerXP') >= $config2->get('MinerMaxExp') ) { // Check Level up
                $config->set('MinerXP',1);
                $config->set('MinerLevel',$config->get('MinerLevel')+ 1);
                $config->save();
                $player->sendMessage($config2->get("MinerLevelUpMessage") . " " . $config->get('MinerLevel')); // Message de level up mineur
            } else {
                $config->set('MinerXP',$config->get('MinerXP') + $config2->get("MinerExpPerBlock")); // Ajout de 0.5 XP par block cassé
                $config->save();
            }


        }


    }


}