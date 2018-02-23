<?php
/*
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Shopware\SwagDefaultSort\Components\DataAccess\Translate;

/**
 * Interface FilterInterface.
 *
 * Simple interface for type-hints
 */
interface FilterInterface
{
    public function filter($value);
}
