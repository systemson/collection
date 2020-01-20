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

use Amber\Collection\Base\ArrayFunctionsTrait;
use Amber\Collection\Base\StatementsTrait;
use Amber\Collection\Base\AliasesTrait;

/**
 * Wrapper class for working with arrays.
 */
class ArrayCollection extends Collection
{
    use ArrayFunctionsTrait, StatementsTrait, AliasesTrait;
}
