<?php

namespace Models\Order;

use Broadway\EventSourcing\EventSourcedAggregateRoot;

/**
 * Description of Order
 *
 * @author jasondt <jason.townsend@techdata.com>
 */
class Order extends EventSourcedAggregateRoot {

    private $orderId;
    private $itemCountById = array();
    private $isSubmitted = false;

    /**
     * @return string
     */
    public function getAggregateRootId() {
        return $this->orderId;
    }

    public function addItem($itemId, $itemName) {
        $this->apply(new ItemAddedEvent($this->orderId, $itemId, $itemName));
    }

    protected function applyItemAddedToOrder(ItemAddedEvent $event) {
        $itemId = $event->getItemId();
        if (!$this->hasItem($itemId)) {
            $this->itemCountById[$itemId] = 0;
        }
        $this->itemCountById[$itemId] ++;
    }

    public function removeItem($itemId) {
        if (!$this->hasItem($itemId)) {
            return;
        }
        $this->apply(new ItemRemovedEvent($this->orderId, $itemId));
    }

    protected function applyItemRemovedFromOrder(ItemRemovedEvent $event) {
        $itemId = $event->getItemId();
        if ($this->hasItem($itemId)) {
            $this->itemCountById[$itemId] --;
            if ($this->itemCountById[$itemId] === 0) {
                unset($this->itemCountById[$itemId]);
            }
        }
    }

    private function hasItem($itemId) {
        return isset($this->itemCountById[$itemId]) && $this->itemCountById[$itemId] > 0;
    }

    public function submit() {
        if (count($this->itemCountById) === 0) {
            throw new EmptyOrderException('Cannot submit an empty order');
        }
        if ($this->isSubmitted) {
            return;
        }
        $this->apply(new OrderSubmitted($this->orderId, $this->itemCountById));
    }

    protected function applyOrderSubmitted(OrderSubmittedEvent $event) {
        $this->isSubmitted = true;
    }

}
