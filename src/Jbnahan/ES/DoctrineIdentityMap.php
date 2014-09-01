<?php

namespace Jbnahan\ES;

use LiteCQRS\EventProviderInterface;
use LiteCQRS\Bus\IdentityMap\IdentityMapInterface;

class DoctrineIdentityMap implements IdentityMapInterface
{
    private $map = array();

    public function add(EventProviderInterface $object)
    {
        $this->map[spl_object_hash($object)] = $object;
    }
    public function all()
    {
        return array_values($this->map);
    }
    public function getAggregateId(EventProviderInterface $object)
    {
        return $object->getId();
    }
}


