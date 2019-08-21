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
        //'iterable',
        'bool',
        'boolean',
        'object',
        'callable',
    ];

    public function __construct($array = [], string $type = 'array')
    {
        parent::__construct($array);

        $this->setType($type);
    }

    public function offsetSet($offset, $value)
    {
        if (!$this->isValidType($value)) {
            $type = gettype($value);

            throw new \RuntimeException("The type of the value [\"{$type}\"]  is not compatible with the [\"{$this->type}\"] type.");
        }

        parent::offsetSet($offset, $value);
    }


    public function setType(string $type): void
    {
        if (in_array($type, static::VALID_TYPES) || (is_string($type) && class_exists($type))) {
            $this->type = $type;
            return;
        }

        throw new \RuntimeException("The type hint [\"{$type}\"] is not a valid type");
    }

    public function getType(): string
    {
        return $this->type;
    }

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
