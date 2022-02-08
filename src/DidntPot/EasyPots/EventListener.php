<?php

namespace DidntPot\EasyPots;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;

class EventListener implements Listener
{
    /**
     * @var Loader
     */
    public Loader $plugin;

    /**
     * @param Loader $plugin
     */
    public function __construct(Loader $plugin)
    {
        $this->plugin = $plugin;
    }

    /**
     * @param PlayerInteractEvent $ev
     */
    public function onInteract(PlayerInteractEvent $ev)
    {
        $player = $ev->getPlayer();
        $action = $ev->getAction();
        $item = $player->getInventory()->getItemInHand();

        if($action === $ev::RIGHT_CLICK_BLOCK)
        {
            if($item->getId() === ItemIds::SPLASH_POTION)
            {
                $player->getInventory()->getItemInHand()->onClickAir($player, $player->getDirectionVector());

                if(!$player->isCreative())
                {
                    $player->getInventory()->setItem($player->getInventory()->getHeldItemIndex(), VanillaItems::AIR());
                }
            }
        }
    }
}