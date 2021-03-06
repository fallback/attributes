<?php declare(strict_types=1);

/*
 * This file is part of the Gocanto Attributes Package
 *
 * (c) Gustavo Ocanto <gustavoocanto@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gocanto\Attributes\Rules;

use Gocanto\Attributes\AttributesException;

interface Constraint
{
    /**
     * @return string
     */
    public function getIdentifier(): string;

    /**
     * @param mixed $value
     * @param string $message
     * @throws AttributesException
     * @return void
     */
    public function assert($value, string $message = ''): void;
}
