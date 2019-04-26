<?php


namespace Rubyliss\SurvivalMmo;

use pocketmine\Player;
use Rubyliss\SurvivalMmo\Main;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\block\BlockBreakEvent;

use pocketmine\Server;

use pocketmine\utils\Config;

class LumberJackJob implements Listener {

    private $main;

    public function __construct(Main $main){
        $this->main = $main;
    }

    public function onBreak(BlockBreakEvent $event){
        $config = new Config($this->main->getDataFolder() . "resources/LevelData/LumberjackLevel/" . strtolower($event->getPlayer()->getName()) . ".yml", Config::YAML);
        $config2 = new Config($this->main->getDataFolder() . "config.yml", Config::YAML);

        $player = $event->getPlayer();
        $name = $player->getName();

        $blocks = array(5, 5.1, 5.2, 5.3, 5.4, 5.5, 17, 17.1, 17.2, 17.3, 43.2, 44.2, 53, 72, 96, 125, 125.1, 125.2, 125.3, 125.4, 125.5, 126, 134, 135, 136, 143, 162, 163, 164);
        if(in_array($event->getBlock()->getId(), $blocks)){
            // Check si c'est un nouveau joueurs, création du fichier level mineur
            if($config->get('LumberjackXP') >= $config2->get('LumberjackMaxExp') ) { // Check Level up
                $config->set('LumberjackXP',1);
                $config->set('LumberjackLevel',$config->get('LumberjackLevel')+ 1);
                $config->save();
                $player->sendMessage($config2->get("LumberjackLevelUpMessage") . " " . $config->get('LumberjackLevel')); // Message de level up mineur
            } else {
                $config->set('LumberjackXP',$config->get('LumberjackXP') + $config2->get("LumberjackExpPerBlock")); // Ajout de 0.5 XP par block cassé
                $config->save();
            }


        }



    }


}