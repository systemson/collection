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

use Amber\Collection\Base\BaseCollection;
use Ds\Collection as CollectionInterface;

/**
 * Wrapper class for working with arrays.
 *
 * @todo MUST add support for searching wildcars. Like: $collection->get('base.{*}.other');
 *       SHOULD return an array if many items are found, else the matching item.
 */
class Collection extends BaseCollection implements CollectionInterface
{
    /**
     * @var string The separator for multilevel keys.
     */
    protected $separator = '.';

    /**
     * @var string The separator for multilevel keys.
     */
    protected $multilevel = false;

    /**
     * Collection constructor
     *
     * @param array $array      The items for the collection.
     * @param bool  $multilevel Defines if the array should handle multilevel keys.
     */
    public function __construct(array $array = [], bool $multilevel = false)
    {
        parent::__construct($array);

        $this->multilevel = $multilevel;
    }

    /**
     * Splits a multilevel key or returns the single level key(s).
     *
     * @param string $key The key to split.
     *
     * @return array|string An array of keys or a single key string.
     */
    protected function splitKey(string $key)
    {
        if (!$this->multilevel) {
            return $key;
        }

        $slug_array = explode($this->separator, $key);

        if (count($slug_array) == 1) {
            return $key;
        }

        return $slug_array;
    }

    /**
     * Sets or updates an item in the collection.
     *
     * @param string $key   The item's key
     * @param mixed  $value The item's value
     *
     * @return void
     */
    public function set(string $key, $value): void
    {
        $slug = $this->splitKey($key);

        if (is_string($slug)) {
            $this[$slug] = $value;
            return;
        }

        $storage = $value;

        foreach (array_reverse($slug) as $id => $key) {
            if ($id === count($slug) - 1) {
                break;
            }

            $aux[$key] = $storage;

            $storage = $aux;
            unset($aux);
        }

        $this[$key] = $storage;
    }

    /**
     * Whether an item is present it the collection
     *
     * @param string $key The item's key
     *
     * @return bool
     */
    public function has(string $key): bool
    {
        $slug = $this->splitKey($key);

        if (is_string($slug)) {
            return isset($this[$slug]);
        }

        $collection = $this->all();

        foreach ($this->splitKey($key) as $search) {
            if (!isset($collection[$search])) {
                return false;
            }

            $collection = $collection[$search];
        }

        return true;
    }

    /**
     * Gets an item from collection.
     *
     * @param string $key The item's key
     *
     * @return mixed|void The item's value or void if the key doesn't exists.
     */
    public function get(string $key)
    {
        $slug = $this->splitKey($key);

        if (is_string($slug)) {
            if (isset($this[$slug])) {
                return $this[$slug];
            }
            return null;
        }

        $array = $this->getArrayCopy();

        foreach ($slug as $search) {
            if (isset($array[$search])) {
                $array = $array[$search];
            } else {
                return;
            }
        }

        return $array;
    }

    /**
     * Deletes an item from collection.
     *
     * @param string $key The item's key
     *
     * @return bool true on success false on failure.
     */
    public function delete(string $key): bool
    {
        $slug = $this->splitKey($key);

        if (is_string($slug)) {
            if (isset($this[$slug])) {
                unset($this[$slug]);
                return true;
            }
            return false;
        }

        if ($this->hasNot($key)) {
            return false;
        }

        $this->set($key, null);

        return true;
    }
}
