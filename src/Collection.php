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

use Amber\Collection\Base\GenericTrait;
use Amber\Collection\Base\EssentialTrait;
use Amber\Collection\Base\SecuentialCollectionTrait;

/**
 * Multi-purpose collection
 */
class Collection extends CollectionCommons
{
    use EssentialTrait, GenericTrait, SecuentialCollectionTrait;
}
