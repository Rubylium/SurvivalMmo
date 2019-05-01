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
        $Farmerlevel = (int) $configFarmer->get('FarmerLevel');

        if($config2->get('EXPtype') === 1 ) {

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

        } else if($config2->get('EXPtype') == 2 ) {

            $MinerXPMax = $configMiner->get('MinerLevel') +  100 * log10($configMiner->get('MinerLevel'));
            $LumberjackXPMax = $configLumberjack->get('LumberjackLevel') +  100 * log10($configLumberjack->get('LumberjackLevel'));
            $FarmerXPMax = $configFarmer->get('FarmerLevel') +  100 * log10($configFarmer->get('FarmerLevel'));

            $Miner100 = 100 - (( $MinerXP * 100 ) / (int) 100 * log10($configMiner->get('MinerLevel')));
            $Lumberjack100 = 100 - (( $LumberjackXP * 100 ) / (int) 100 * log10($configMiner->get('MinerLevel')));
            $Farmer100 = 100 - (( $FarmerXP * 100 ) / (int) 100 * log10($configMiner->get('MinerLevel')));

            $sender->sendMessage('§k§e!!§r §7-------------------- §k§e!!');
            $sender->sendMessage(' ');
            $sender->sendMessage('§6Miner');
            $sender->sendMessage('§bLevel:§7 '.$Minerlevel);
            $sender->sendMessage('§bXP:§7 '. $MinerXP . '§a/§7'. (int) $MinerXPMax . "" );
            $sender->sendMessage("§7".(int) $Miner100."§e%§7 Until your next level");
            $sender->sendMessage('§7--------------------');
            $sender->sendMessage('§6Lumberjack');
            $sender->sendMessage('§bLevel:§7 '.$Lumberjacklevel);
            $sender->sendMessage('§bXP:§7 '. $LumberjackXP . '§a/§7'. (int) $LumberjackXPMax . "" );
            $sender->sendMessage("§7".(int) $Lumberjack100."§e%§7 Until your next level");
            $sender->sendMessage('§7--------------------');
            $sender->sendMessage('§6Farmer');
            $sender->sendMessage('§bLevel:§7 '.$Farmerlevel);
            $sender->sendMessage('§bXP:§7 '. $FarmerXP . '§a/§7'. (int) $FarmerXPMax . "" );
            $sender->sendMessage("§7".(int) $Farmer100."§e%§7 Until your next level");
            $sender->sendMessage(' ');
            $sender->sendMessage(' ');
            $sender->sendMessage('§k§e!!§r §7-------------------- §k§e!!');


        }

    }




}