<?php

namespace Order\Event;

use Broadway\Serializer\SerializableInterface;

/**
 * Description of AbstractOrderEvent
 *
 * @author jasondt <jason.townsend@techdata.com>
 */
abstract class OrderEvent implements SerializableInterface {

    private $orderId;

    public function __construct(OrderId $orderId) {
        $this->orderId = $orderId;
    }

    /**
     * @return BasketId
     */
    public function getOrderId() {
        return $this->orderId;
    }

    /**
     * {@inheritDoc}
     */
    public function serialize() {
        return array('orderId' => (string) $this->orderId);
    }

}
