<?php

namespace Order;

use Assert\Assertion as Assert;
use Broadway\CommandHandling\CommandBusInterface;
use Broadway\UuidGenerator\UuidGeneratorInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Order\Command\AddItemCommand;
use Order\Command\RemoveItemCommand;
use Order\Command\SubmitOrderCommand;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Description of OrderService
 *
 * @author jasondt <jason.townsend@techdata.com>
 * 
 * @Service("order.service")
 * @Route("/Orders", service="order.service")
 */
class OrderServiceImpl implements OrderService {

    private $commandBus;
    private $uuidGenerator;

    /**
     * @InjectParams({
     *     "commandBus" = @Inject("broadway.command_handling.command_bus"),
     *     "uuidGenerator" = @Inject("broadway.uuid.generator")
     * })
     */
    public function __construct(CommandBusInterface $commandBus, UuidGeneratorInterface $uuidGenerator) {
        $this->commandBus = $commandBus;
        $this->uuidGenerator = $uuidGenerator;
    }

    /**
     * @Route("/", name="order_create" )
     * @Method("POST")
     * @return JsonResponse
     */
    public function createOrder() {
        return new JsonResponse();
    }

    /**
     * @Route("/{order_id}/add/{item_id}", name="order_add_item" )
     * @Method("POST")
     * @return JsonResponse
     */
    public function addOrderItem(OrderId $orderId, $itemId) {
        Assert::uuid($itemId);
        $command = new AddItemCommand($orderId, $itemId);
        $this->commandBus->dispatch($command);

        return new JsonResponse();
    }

    /**
     * @Route("/{order_id}/remove/{item_id}", name="order_remove_item" )
     * @Method("POST")
     * @return JsonResponse
     */
    public function removeOrderItem(OrderId $orderId, $itemId) {
        Assert::uuid($itemId);
        $command = new RemoveItemCommand($orderId, $itemId);
        $this->commandBus->dispatch($command);

        return new JsonResponse();
    }

    /**
     * @Route("/{order_id}/submit", name="order_submit" )
     * @Method("POST")
     * @return JsonResponse
     */
    public function submitOrder(OrderId $orderId) {
        $command = new SubmitOrderCommand($orderId);
        $this->commandBus->dispatch($command);

        return new JsonResponse();
    }

    /**
     * @Route("/", name="orders_get" )
     * @Method("GET")
     * @return JsonResponse
     */
    public function getOrders() {
        return new JsonResponse(array('orders' => array("1", "2", "3")));
    }

}
