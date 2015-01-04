<?php

namespace Order;

use Assert\Assertion as Assert;
use Common\Identifier;

/**
 * Description of OrderId
 *
 * @author jasondt <jason.townsend@techdata.com>
 */
class OrderId implements Identifier {

    private $orderId;

    /**
     * @param string $orderId
     */
    public function __construct($orderId) {
        Assert::string($orderId);
        Assert::uuid($orderId);
        $this->orderId = $orderId;
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->orderId;
    }

}
