<?php

namespace Order\Command;

use Broadway\CommandHandling\CommandHandler;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;

/**
 * Description of OrderCommandHandler
 *
 * @author jasondt <jason.townsend@techdata.com>
 * @Service("order.command_handler")
 * @Tag("command_handler")
 */
class OrderCommandHandler extends CommandHandler {

    private $repository;

    /**
     * @InjectParams({
     *     "repository" = @Inject("order.repository")
     * })
     */
    public function __construct(OrderRepository $repository) {
        $this->repository = $repository;
    }

    protected function handleAddItemCommand(AddItemCommand $command) {
        $order = $this->repository->load($command->getOrderId());
        $order->addItem($command->getItemId(), $command->getItemName());
        $this->repository->add($order);
    }

    public function handleRemoveItemCommand(RemoveItemCommand $command) {
        $order = $this->repository->load($command->getOrderId());
        $order->removeItem($command->getProductId());
        $this->repository->add($order);
    }

    public function handleSubmitOrderCommand(SubmitOrderCommand $command) {
        $order = $this->repository->load($command->getOrderId());
        $order->submit();
        $this->repository->add($order);
    }

}
