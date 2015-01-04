<?php

namespace Order;

use Broadway\EventHandling\EventBusInterface;
use Broadway\EventSourcing\AggregateFactory\PublicConstructorAggregateFactory;
use Broadway\EventSourcing\EventSourcingRepository;
use Broadway\EventStore\EventStoreInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;

/**
 * Description of OrderRepository
 *
 * @author jasondt <jason.townsend@techdata.com>
 * @Service("order.repository")
 */
class OrderRepository extends EventSourcingRepository {
    /**
     * @InjectParams({
     *     "eventStore" = @Inject("broadway.event_store"),
     *     "eventBus" = @Inject("broadway.event_handling.event_bus"),
     *     "eventStreamDecorators" = @Inject("%event_stream_decorators%")
     * })
     */
    public function __construct(EventStoreInterface $eventStore, EventBusInterface $eventBus, array $eventStreamDecorators = array()) {
        parent::__construct($eventStore, $eventBus, '\Models\Order', new PublicConstructorAggregateFactory(), $eventStreamDecorators);
    }

}
