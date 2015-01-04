<?php

namespace Order\Event;

use Order\OrderId;

/**
 * Description of OrderWasSubmitted
 *
 * @author jasondt <jason.townsend@techdata.com>
 */
class OrderSubmittedEvent extends OrderEvent {

    /**
     * {@inheritDoc}
     */
    public static function deserialize(array $data) {
        return new self(new OrderId($data['orderId']));
    }

}
