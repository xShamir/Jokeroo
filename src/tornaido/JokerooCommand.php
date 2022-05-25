<?php
declare(strict_types=1);

namespace tornaido;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;

class JokerooCommand extends Command implements PluginOwned
{

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        $prefix = Jokeroo::$prefix;

        try {
            $api_url = "https://v2.jokeapi.dev/joke/Any?type=twopart";
            $joke = json_decode(file_get_contents($api_url));

            if(!$joke->error)
            {
                $sender->sendMessage($prefix . $joke->setup . "\n          " . $joke->delivery);
            }

        } catch (\Exception $e)
        {
            Jokeroo::$instance->getLogger()->info($e->getMessage());
        }

    }

    public function getOwningPlugin(): Plugin
    {
        return Jokeroo::$instance;
    }
}