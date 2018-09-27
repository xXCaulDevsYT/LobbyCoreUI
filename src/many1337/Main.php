<?php

namespace many1337;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use muqsit\invmenu\InvMenuHandler;
use pocketmine\Server;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\Listeners;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener
{

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onDisable()
    {
        foreach ($this->getServer()->getOnlinePlayers() as $p) {
            $p->transfer("80.99.208.62", "1941");
        }
    }

    public function onJoin(PlayerJoinEvent $event)
    {

        $player = $event->getPlayer();
        $name = $player->getName();
        $this->Main($player);
        $event->setJoinMessage("§7[§9+§7] §9" . $name);

    }

    public function onQuit(PlayerQuitEvent $event)
    {

        $player = $event->getPlayer();
        $name = $player->getName();
        $event->setQuitMessage("§7[§c-§7] §c" . $name);

    }

    public function onPlace(BlockPlaceEvent $ev)
    {
		$ev->setCancelled(true);
    }

    public function Hunger(PlayerExhaustEvent $ev)
    {
		$ev->setCancelled(true);
    }

    public function ItemMove(PlayerDropItemEvent $ev)
    {
		$ev->setCancelled(true);
    }

    public function onConsume(PlayerItemConsumeEvent $ev)
    {
		$ev->setCancelled(true);
    }

    public function Main(Player $player)
    {
        $player->getInventory()->clearAll();
        $player->getInventory()->setItem(4, Item::get(345)->setCustomName(TextFormat::YELLOW . "Navigator"));
        $player->getInventory()->setItem(8, Item::get(399)->setCustomName(TextFormat::GREEN . "Infos"));
        $player->getInventory()->setItem(0, Item::get(397, 3)->setCustomName(TextFormat::AQUA . "Profile"));

    }

    public function onInteract(PlayerInteractEvent $event)
    {
        $player = $event->getPlayer();
        $item = $player->getInventory()->getItemInHand();

        if ($item->getCustomName() == TextFormat::YELLOW . "Navigator") {
            $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
            $form = $api->createSimpleForm(function (Player $sender, $data) {
                $result = $data[0];

                if ($result === null) {
                    return true;
                }
                switch ($result) {
                    case 0:
                        $command = "transferserver 127.0.0.1 1";
                        $this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
                    case 1:
                        $command = "transferserver 127.0.0.1 2";
                        $this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
                    case 2:
                        $command = "transferserver 127.0.0.1 3";
                        $this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
                    case 3:
                        $command = "transferserver 127.0.0.1 4";
                        $this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
                    case 4:
                        $command = "transferserver 127.0.0.1 5";
                        $this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;


                }
            });
            $form->setTitle("§l§aServer Selector");
            $form->setContent("Answer a server for teleporting");
            $form->addButton(TextFormat::BOLD . "§aSkyBlock §7- §7[§cCLOSED§7]");
            $form->addButton(TextFormat::BOLD . "§aFast§fBridge §7- §7[§cCLOSED§7]");
            $form->addButton(TextFormat::BOLD . "§aSkyWars §7- §7[§cCLOSED§7]");
            $form->addButton(TextFormat::BOLD . "§aBedWars §7- §7[§cCLOSED§7]");
            $form->addButton(TextFormat::BOLD . "§aHungerGames §7- §7[§cCLOSED§7]");
            $form->sendToPlayer($player);

        }
    }
}
