<?php

namespace Order\Command;

use Order\OrderId;

/**
 * Description of RemoveItemCommand
 *
 * @author jasondt <jason.townsend@techdata.com>
 */
class RemoveItemCommand extends OrderCommand {

    private $itemId;

    /**
     * @param string $itemId
     */
    public function __construct(OrderId $orderId, $itemId) {
        parent::__construct($orderId);
        $this->itemId = $itemId;
    }

    /**
     * @return string
     */
    public function getItemId() {
        return $this->itemId;
    }

}
