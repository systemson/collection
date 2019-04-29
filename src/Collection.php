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
use ArrayObject;
use Ds\Collection as CollectionInterface;
use Amber\Collection\Base\GenericTrait;

/**
 * Wrapper class for working with arrays.
 *
 * @todo SHOULD be renamed to Vector or ArrayObject
 */
class Collection extends ArrayObject implements CollectionInterface
{
    use BaseCollection, GenericTrait;
}
