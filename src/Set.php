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

use Amber\Collection\Base\ArrayObject;
use Amber\Collection\Base\BaseCollection;
use Ds\Collection as CollectionInterface;
use Closure;
use Amber\Collection\Implementations\Pair;
use Amber\Collection\Implementations\GenericTrait;

/**
 * A sequential collection of key-value pairs.
 */
class Set extends ArrayObject implements CollectionInterface
{
    use BaseCollection, GenericTrait;

    protected function getByValue($offset)
    {
        foreach ($this as $index => $value) {
            if ($value === $offset) {
                return [
                    'index' => $index,
                    'value' => $value,
                ];
            }
        }
        return [];
    }

    public function offsetSet($offset, $value)
    {
        parent::offsetSet(null, $value);
    }

    public function offsetExists($offset)
    {
        $ret = $this->getByValue($offset);

        return !empty($ret);
    }

    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) {
            $ret = $this->getByValue($offset);

            parent::offsetUnset($ret['index']);
        }
    }

    public function &offsetGet($offset)
    {
        $ret =& $this->getByValue($offset)['value'] ?? null;

        return $ret;
    }
}
