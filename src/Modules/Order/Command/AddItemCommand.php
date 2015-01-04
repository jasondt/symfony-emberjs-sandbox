<?php

namespace Order\Command;

use Order\OrderId;

/**
 * Description of AddItemToOrder
 *
 * @author jasondt <jason.townsend@techdata.com>
 */
class AddItemCommand extends OrderCommand {

    /**
     * @param string $itemId
     * @param string $itemName
     */
    public function __construct(OrderId $orderId, $itemId, $itemName) {
        parent::__construct($orderId);
        $this->itemId = $itemId;
        $this->itemName = $itemName;
    }

    /**
     * @return string
     */
    public function getItemId() {
        return $this->itemId;
    }

    /**
     * @return string
     */
    public function getItemName() {
        return $this->itemName;
    }

}
