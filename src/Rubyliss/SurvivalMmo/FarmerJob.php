<?php


namespace Rubyliss\SurvivalMmo;

use pocketmine\Player;
use Rubyliss\SurvivalMmo\Main;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;

use pocketmine\Server;

use pocketmine\utils\Config;

class FarmerJob implements Listener {

    private $main;

    public function __construct(Main $main){
        $this->main = $main;
    }

    public function onBreak(BlockBreakEvent $event){
        $config = new Config($this->main->getDataFolder() . "resources/LevelData/FarmerLevel/" . strtolower($event->getPlayer()->getName()) . ".yml", Config::YAML);
        $config2 = new Config($this->main->getDataFolder() . "config.yml", Config::YAML);

        $player = $event->getPlayer();
        $name = $player->getName();
        $blocks = [59, 244, 60, 105, 104];
        if(in_array($event->getBlock()->getId(), $blocks)){
            if($config->get('FarmerXP') >= $config2->get('FarmerMaxExp') ) { // Check Level up
                $config->set('FarmerXP',1);
                $config->set('FarmerLevel',$config->get('FarmerLevel')+ 1);
                $config->save();
                $player->sendMessage($config2->get("FarmerLevelUpMessage") . " " . $config->get('FarmerLevel')); // Message de level up mineur
            } else {
                $config->set('FarmerXP',$config->get('FarmerXP') + $config2->get("FarmerExpPerBlock"));
                $config->save();
            }


        }



    }

    public function onPlace(BlockPlaceEvent $event){
        $config = new Config($this->main->getDataFolder() . "resources/LevelData/FarmerLevel/" . strtolower($event->getPlayer()->getName()) . ".yml", Config::YAML);
        $config2 = new Config($this->main->getDataFolder() . "config.yml", Config::YAML);

        $player = $event->getPlayer();
        $name = $player->getName();

        $blocks = [59, 244, 60, 105, 104];
        if(in_array($event->getBlock()->getId(), $blocks)){
            if($config->get('FarmerXP') >= $config2->get('FarmerMaxExp') ) { // Check Level up
                $config->set('FarmerXP',1);
                $config->set('FarmerLevel',$config->get('FarmerLevel')+ 1);
                $config->save();
                $player->sendMessage($config2->get("FarmerLevelUpMessage") . " " . $config->get('FarmerLevel')); // Message de level up mineur
            } else {
                $config->set('FarmerXP',$config->get('FarmerXP') + $config2->get("FarmerExpPerBlockPlace"));
                $config->save();
            }


        }



    }


}