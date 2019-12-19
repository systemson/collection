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

/**
 * Hint typed collection.
 */
class TypedCollection extends Collection
{
    /**
     * @var mixed $type;
     */
    protected $type;

    const VALID_TYPES = [
        'numeric',
        'integer',
        'int',
        'double',
        'float',
        'string',
        'array',
        //'iterable',
        'bool',
        'boolean',
        'object',
        'callable',
    ];

    /**
     * Collection constructor.
     *
     * @param array $array The items for the new collection.
     */
    public function __construct($array = [], string $type = 'array')
    {
        $this->setType($type);

        $this->setMultiple($this->extractArray($array));
    }

    /**
     * Sets a value at the specified key/index.
     *
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        if (!$this->validateType($value)) {
            $type = gettype($value);

            throw new \RuntimeException("The type of the value [\"{$type}\"]  is not compatible with the [\"{$this->type}\"] type.");
        }

        parent::offsetSet($offset, $value);
    }

    /**
     * Sets the type of the collection.
     *
     * @param string $type
     *
     * @return void
     */
    public function setType(string $type): void
    {
        if (in_array($type, static::VALID_TYPES) || class_exists($type)) {
            $this->type = $type;
            return;
        }

        throw new \RuntimeException("The type hint [\"{$type}\"] is not a valid type");
    }

    /**
     * Returns the collection type.
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Validates the value's type.
     *
     * @param mixed $value
     *
     * @return bool
     */
    protected function validateType($value): bool
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
                return is_string($this->type) && class_exists($this->type) && is_a($value, $this->type, true);
                break;
        }
    }
}