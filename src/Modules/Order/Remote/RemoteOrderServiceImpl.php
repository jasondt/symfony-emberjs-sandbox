<?php

namespace Order\Remote;

use Order\OrderService;

/**
 * Description of RemoteOrderService
 *
 * @author jasondt <jason.townsend@techdata.com>
 */
class RemoteOrderService implements OrderService {

    private $client;

    function __construct(OrderClient $client) {
        $this->client = $client;
    }

    public function createOrder() {
        
    }

    public function getOrders() {
        
    }

}
