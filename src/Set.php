<?php
/**
 * This file is part of the Amber/Collection package.
 *
 * @package Amber/Collection
 * @author  Deivi Peña <systemson@gmail.com>
 * @license GPL-3.0-or-later
 * @license https://opensource.org/licenses/gpl-license GNU Public License
 */

namespace Amber\Collection;

use Amber\Collection\Contracts\CollectionInterface;
use Amber\Collection\Base\MixedKeysTrait;

/**
 * A sequential collection of key-value pairs.
 */
class Set extends CollectionCommons implements CollectionInterface
{
    use MixedKeysTrait;

    protected function getIndex($offset)
    {
        return array_search($offset, $this->toArray());
    }

    public function offsetSet($offset, $value)
    {
        parent::offsetSet($this->getIndex($offset), $value);
    }

    public function offsetExists($offset)
    {
        return in_array($offset, $this->toArray());
    }

    public function offsetUnset($offset)
    {
        parent::offsetUnset($this->getIndex($offset));
    }

    public function &offsetGet($offset)
    {
        $ret =& parent::offsetGet($this->getIndex($offset)) ?? null;

        return $ret;
    }

    /**
     * Deletes an item from collection.
     *
     * @param string $key The item's key
     *
     * @return bool true on success, false on failure.
     */
    public function delete($key): bool
    {
        if ($this->hasNot($key)) {
            return false;
        }

        $this->unset($key);

        return true;
    }

    /**
     * Whether an item is not present it the collection
     *
     * @param string $key The item's key
     *
     * @return bool
     */
    public function hasNot($key): bool
    {
        return !$this->has($key);
    }
}
