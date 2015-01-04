<?php

namespace Order\Command;

use Assert\Assertion as Assert;
use Common\Identifier;

/**
 * Description of OrderCommand
 *
 * @author jasondt <jason.townsend@techdata.com>
 */
final class OrderCommand implements Identifier {

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
