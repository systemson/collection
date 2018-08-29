<?php

namespace Amber\Collection\Base;

use Amber\Config\ConfigAwareTrait;
use Amber\Config\ConfigAwareInterface;
use Ds\Collection as CollectionInterface;

/**
 * Implements the basis for the Collection.
 *
 * @todo MUST implement Ds/Collection interface.
 */
abstract class BaseCollection extends \ArrayObject implements ConfigAwareInterface
{
    use ConfigAwareTrait, Essential;

    public function __construct($array = [])
    {
        parent::__construct($array);

        $this->setFlags(static::ARRAY_AS_PROPS);
    }

    public function put($key, $value)
    {
        $this[$key] = $value;
    }

    public function push($value)
    {
        $this[] = $value;
    }

    public function get($key)
    {
        return $this[$key];
    }

    public function has($key)
    {
        return isset($this[$key]);
    }

    public function remove($key)
    {
        unset($this[$key]);
    }
}
