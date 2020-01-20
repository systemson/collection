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

use Amber\Collection\Base\GenericEncapsulationTrait;
use Amber\Collection\Base\EssentialTrait;
use Amber\Collection\Base\SequentialCollectionTrait;

/**
 * Hint typed collection.
 */
class TypedCollection extends Collection
{
    protected $type;

    const VALID_TYPES = [
        'numeric',
        'integer',
        'int',
        'double',
        'float',
        'string',
        'array',
        'iterable',
        'bool',
        'boolean',
        'object',
        'callable',
    ];

    /**
     * Collection constructor.
     *
     * @param array|Arrayable $array The items for the new collection.
     */
    public function __construct(array $array = [], string $type = 'array')
    {
        parent::__construct($array);

        $this->setType($type);
    }

    /**
     * Whether the provided type is a class.
     */
    protected function isClass($type): bool
    {
        return is_string($type) && (class_exists($type) || interface_exists($type));
    }

    /**
     * Sets the collection type hint.
     */
    protected function setType(string $type): void
    {
        if (in_array($type, static::VALID_TYPES) || $this->isClass($type)) {
            $this->type = $type;
            return;
        }

        throw new \RuntimeException("The type hint [\"{$type}\"] is not a valid type");
    }

    /**
     * Gets the collection's type.
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Sets an element in the collection at the specified key/index.
     */
    public function offsetSet($offset, $value)
    {
        if (!$this->isValidType($value)) {
            $type = gettype($value);

            throw new \RuntimeException("The type of [\"{$type}\"]  is not compatible with the [\"{$this->type}\"] type.");
        }

        parent::offsetSet($offset, $value);
    }

    /**
     * Whether the provided value is a valid type.
     */
    protected function isValidType($value): bool
    {
        switch ($this->type) {
            case 'numeric':
                return is_numeric($value);
                break;

            case 'integer':
            case 'int':
                return is_int($value);
                break;

            case 'double':
            case 'float':
                return is_double($value);
                break;

            case 'string':
                return is_string($value);
                break;

            case 'array':
                return is_array($value);
                break;

            case 'iterable':
                return is_iterable($value);
                break;

            case 'bool':
            case 'boolean':
                return is_bool($value);
                break;

            case 'object':
                return is_object($value);
                break;

            case 'callable':
                return is_callable($value);
                break;

            default:
                return $this->isClass($this->type) && is_a($value, $this->type, true);
                break;
        }
    }
}
