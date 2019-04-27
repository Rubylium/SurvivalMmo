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

        $MinerXP = (int) $configMiner->get('MinerXP');
        $Minerlevel = $configMiner->get('MinerLevel');
        $LumberjackXP = (int) $configLumberjack->get('LumberjackXP');
        $Lumberjacklevel = $configLumberjack->get('LumberjackLevel');

        $sender->sendMessage('§k§e!!§r §7-------------------- §k§e!!');
        $sender->sendMessage(' ');
        $sender->sendMessage(' ');
        $sender->sendMessage('§bMiner Level:§7 '.$Minerlevel);
        $sender->sendMessage('§bMiner XP:§7 '. $MinerXP . '§a/§7'. $config2->get('MinerMaxExp') . "" );
        $sender->sendMessage('§7--------------------');
        $sender->sendMessage('§bLumberjack Level:§7 '.$Lumberjacklevel);
        $sender->sendMessage('§bLumberjack XP:§7 '. $LumberjackXP . '§a/§7'. $config2->get('LumberjackMaxExp') . "" );
        $sender->sendMessage(' ');
        $sender->sendMessage(' ');
        $sender->sendMessage('§k§e!!§r §7-------------------- §k§e!!');
    }
}