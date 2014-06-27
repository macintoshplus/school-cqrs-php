<?php

namespace Jbnahan\ES;

use LiteCQRS\EventStore;
use LiteCQRS\Serializer\ReflectionSerializer;
use Jbnahan\ES\DoctrineStorage;

class EventStoreFactory
{
    static public function get($doctrine)
    {
        return new EventStore\OptimisticLocking\OptimisticLockingEventStore(
            new DoctrineStorage($doctrine),
            new ReflectionSerializer()
        );
    }
}