<?php

namespace Rubyliss\SurvivalMmo;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use Rubyliss\SurvivalMmo\Main;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;
use pocketmine\Player;
class LevelCommand extends PluginCommand
{
    private $main;
    public function __construct(Main $main, $name)
    {
        parent::__construct($name, $main);
        $this->main = $main;
    }
    public function execute(CommandSender $sender, $currentAlias, array $args)

    {
        $configMiner = new Config($this->main->getDataFolder() . "resources/LevelData/MinerLevel/" . strtolower($sender->getName()) . ".yml", Config::YAML);
        $config2 = new Config($this->main->getDataFolder() . "config.yml", Config::YAML);
        $configLumberjack = new Config($this->main->getDataFolder() . "resources/LevelData/LumberjackLevel/" . strtolower($sender->getName()) . ".yml", Config::YAML);
        $configFarmer = new Config($this->main->getDataFolder() . "resources/LevelData/FarmerLevel/" . strtolower($sender->getName()) . ".yml", Config::YAML);

        $MinerXP = (int) $configMiner->get('MinerXP');
        $Minerlevel = $configMiner->get('MinerLevel');
        $LumberjackXP = (int) $configLumberjack->get('LumberjackXP');
        $Lumberjacklevel = $configLumberjack->get('LumberjackLevel');
        $FarmerXP = (int) $configFarmer->get('FarmerXP');
        $Farmerlevel = $configFarmer->get('FarmerLevel');

        $Miner100 = (int) 100 - (( $MinerXP * 100 ) / $config2->get('MinerMaxExp'));
        $Lumberjack100 = (int) 100 - (( $LumberjackXP * 100 ) / $config2->get('LumberjackMaxExp'));
        $Farmer100 = (int) 100 - (( $FarmerXP * 100 ) / $config2->get('FarmerMaxExp'));

        $sender->sendMessage('§k§e!!§r §7-------------------- §k§e!!');
        $sender->sendMessage(' ');
        $sender->sendMessage('§6Miner');
        $sender->sendMessage('§bLevel:§7 '.$Minerlevel);
        $sender->sendMessage('§bXP:§7 '. $MinerXP . '§a/§7'. $config2->get('MinerMaxExp') . "" );
        $sender->sendMessage("§7".$Miner100."§e%§7 Until your next level");
        $sender->sendMessage('§7--------------------');
        $sender->sendMessage('§6Lumberjack');
        $sender->sendMessage('§bLevel:§7 '.$Lumberjacklevel);
        $sender->sendMessage('§bXP:§7 '. $LumberjackXP . '§a/§7'. $config2->get('LumberjackMaxExp') . "" );
        $sender->sendMessage("§7".$Lumberjack100."§e%§7 Until your next level");
        $sender->sendMessage('§7--------------------');
        $sender->sendMessage('§6Farmer');
        $sender->sendMessage('§bLevel:§7 '.$Farmerlevel);
        $sender->sendMessage('§bXP:§7 '. $FarmerXP . '§a/§7'. $config2->get('FarmerMaxExp') . "" );
        $sender->sendMessage("§7".$Farmer100."§e%§7 Until your next level");
        $sender->sendMessage(' ');
        $sender->sendMessage(' ');
        $sender->sendMessage('§k§e!!§r §7-------------------- §k§e!!');
    }
}