<?php
declare(strict_types=1);

namespace tornaido;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Jokeroo extends PluginBase
{

    public static self $instance;
    public static string $prefix;

    private Config $config;

    public function onEnable(): void
    {
        self::$instance = $this;

        $configPath = $this->getDataFolder() . "config.yml";

        if(!file_exists($configPath))
        {
            $this->getLogger()->notice("I've spotted it's your first time using Jokeroo! To change Jokeroo's configurations head on over to pluginData -> Jokeroo -> config.yml & adjust everything according to your own liking.");
        }

        $this->config = $this->getConfig();
        $this->saveDefaultConfig();

        self::$prefix = $this->config->get("Prefix");

        $configVersion = $this->config->get("Version", 1.0);
        $pluginVersion = $this->getDescription()->getVersion();

        if(version_compare($pluginVersion, $configVersion, "gt"))
        {
            $this->getLogger()->warning("I've spotted you are using an outdated version of the plugin's config, It is advised to delete your Jokeroo plugin data & redo all your configurations for optimal performance.");
        }

        $this->getServer()->getCommandMap()->register("jokeroo", new JokerooCommand("joke", "I'll throw a joke upon you!", "/joke"));

        $this->getLogger()->info("§8§l(§2+§8) §r§aPlugin enabled!");
    }

    public function onDisable(): void
    {
        $this->getLogger()->info("§8§l(§4-§8) §r§cPlugin disabled!");
    }
}