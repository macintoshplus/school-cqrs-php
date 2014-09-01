<?php

namespace Jbnahan\ES;

use LiteCQRS\DomainEventProviderRepositoryInterface;
use LiteCQRS\EventProviderInterface;
use LiteCQRS\EventStore\EventStoreInterface;
use LiteCQRS\Bus\IdentityMap\IdentityMapInterface;

class DoctrineRepository implements DomainEventProviderRepositoryInterface
{
    private $event_store;
    private $map;

    public function __construct(EventStoreInterface $event_store, IdentityMapInterface $map)
    {
        $this->event_store = $event_store;
        $this->map = $map;
    }

    public function find($class, $id)
    {
        $events = $this->event_store->find($class, $id);

        $reflClass = new \ReflectionClass($aggregateRootClass);

        $aggregateRoot = $reflClass->newInstanceWithoutConstructor();
        $aggregateRoot->loadFromHistory($events);

        return $aggregateRoot;
    }

    public function add(EventProviderInterface $object)
    {
    	$this->map->add($object);
        //$this->event_store->persist($object);
    }

    public function remove(EventProviderInterface $object)
    {
        //$this->event_store->remove($object);
    }
}

