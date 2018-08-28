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

    /**
     * @todo Should reimplement the array functions on independend methods.
     */
    public function __call($method, $args = [])
    {
        if (method_exists($this, $method)) {
            return call_user_func_array([$this, $method], $args);
        } elseif (function_exists('array_' . $method)) {
            return call_user_func_array('array_' . $method, $args);
        }
    }
}
