<?php

namespace Order\Event;

use Order\OrderId;

/**
 * Description of ItemAddedToOrder
 *
 * @author jasondt <jason.townsend@techdata.com>
 */
class ItemAddedEvent extends OrderEvent {

    private $itemId;
    private $itemName;

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

    /**
     * {@inheritDoc}
     */
    public static function deserialize(array $data) {
        return new self(
                new OrderId($data['orderId']), $data['itemId'], $data['itemName']
        );
    }

    /**
     * {@inheritDoc}
     */
    public function serialize() {
        return array_merge(parent::serialize(), array(
            'itemId' => $this->itemId,
            'itemName' => $this->itemName,
        ));
    }

}
