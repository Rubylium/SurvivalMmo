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
        $config = new Config($this->main->getDataFolder() . "resources/LevelData/MineurLevel/" . strtolower($sender->getName()) . ".yml", Config::YAML);
        $config2 = new Config($this->main->getDataFolder() . "config.yml", Config::YAML);

        $MinerXP = (int) $config->get('MinerXP');
        $Minerlevel = $config->get('MinerLevel');

        $sender->sendMessage('§k§e!!§r §7-------------------- §k§e!!');
        $sender->sendMessage(' ');
        $sender->sendMessage(' ');
        $sender->sendMessage('§bMiner Level:§7 '.$Minerlevel);
        $sender->sendMessage('§bMiner XP:§7 '. $MinerXP . '§a/§7'. $config2->get('MaxExp') . "" );
        $sender->sendMessage(' ');
        $sender->sendMessage(' ');
        $sender->sendMessage('§k§e!!§r §7-------------------- §k§e!!');
    }
}