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
        $config = new Config($this->main->getDataFolder() . "resources/LevelData/MineurLevel/" . strtolower($event->getPlayer()->getName()) . ".yml", Config::YAML);
        $config2 = new Config($this->main->getDataFolder() . "config.yml", Config::YAML);

        $player = $event->getPlayer();
        $name = $player->getName();

        // Check si c'est un nouveau joueurs, création du fichier level mineur
        if($config->get('MinerXP') >= $config2->get('MaxExp') ) { // Check Level up
            $config->set('MinerXP',1);
            $config->set('MinerLevel',$config->get('MinerLevel')+ 1);
            $config->save();
            $player->sendMessage($config2->get("MinerLevelUpMessage") . " " . $config->get('MinerLevel')); // Message de level up mineur
        } else {
            $config->set('MinerXP',$config->get('MinerXP') + 0.5); // Ajout de 0.5 XP par block cassé
            $config->save();
        }



    }


}