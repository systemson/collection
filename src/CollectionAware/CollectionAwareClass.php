<?php
/**
 * This file is part of the Amber/Collection package.
 *
 * @package Amber/Collection
 * @author Deivi Peña <systemson@gmail.com>
 * @license GPL-3.0-or-later
 * @license https://opensource.org/licenses/gpl-license GNU Public License
 */

namespace Amber\Collection\CollectionAware;

/**
 * Implements the CollectionAwareInterface
 */
abstract class CollectionAwareClass implements CollectionAwareInterface
{
    use CollectionAwareTrait;
}
