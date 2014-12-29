<?php

namespace Services;

use JMS\DiExtraBundle\Annotation\Service;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Description of Orders Service
 *
 * @author jasondt <jason.townsend@techdata.com>
 * 
 * @Service("orders")
 * @Route("/Orders", service="orders")
 */
class Orders {

    /**
     * @Route("/", name="orders_all" )
     * @Method("GET")
     * @return JsonResponse
     */
    public function all() {
        return new JsonResponse(array('orders' => array("1","2","3")));
    }

}
