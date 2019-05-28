<?php
/**
 * This file is part of the Amber/Collection package.
 *
 * @package Amber/Collection
 * @author  Deivi Peña <systemson@gmail.com>
 * @license GPL-3.0-or-later
 * @license https://opensource.org/licenses/gpl-license GNU Public License
 */

namespace Amber\Collection\Base;

/**
 * Implements the basis for the Collection.
 *
 * @todo Should return self on methods returning void.
 */
trait BaseCollection
{
    use ArrayFunctionsTrait, StatementsTrait, AliasesTrait;
}
