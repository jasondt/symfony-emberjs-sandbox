<?php

namespace Order\Event;

use Order\OrderId;

/**
 * Description of ItemRemovedEvent
 *
 * @author jasondt <jason.townsend@techdata.com>
 */
class ItemRemovedEvent extends OrderEvent {

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

    /**
     * {@inheritDoc}
     */
    public static function deserialize(array $data) {
        return new self(
                new OrderId($data['orderId']), $data['itemId']
        );
    }

    /**
     * {@inheritDoc}
     */
    public function serialize() {
        return array_merge(parent::serialize(), array(
            'itemId' => $this->itemId,
        ));
    }

}
