<?php

namespace Order;

/**
 * Description of OrderService
 *
 * @author jasondt <jason.townsend@techdata.com>
 * 
 */
interface OrderService {

    public function createOrder();

    public function getOrders();
}
