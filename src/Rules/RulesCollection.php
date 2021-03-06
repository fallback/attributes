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
use Gocanto\Attributes\Support\Arr;

final class RulesCollection
{
    /** @var array<string, ConstraintsCollection> */
    private $rules = [];

    /**
     * @param array<string, mixed> $rules
     * @throws AttributesException
     */
    public function __construct(array $rules)
    {
        $this->addMany($rules);
    }

    /**
     * @param array<string, mixed> $rules
     * @throws AttributesException
     */
    public function addMany(array $rules): void
    {
        foreach ($rules as $field => $constraints) {
            $this->add($field, $constraints);
        }
    }

    /**
     * @param string $field
     * @param array<int, Constraint> $constraints
     * @throws AttributesException
     */
    public function add(string $field, array $constraints): void
    {
        if (Arr::exists($this->rules, $field)) {
            throw new AttributesException("The given field [{$field}] constraints already exist.");
        }

        if (empty($constraints)) {
            throw new AttributesException("The given field [{$field}] constraints are required.");
        }

        $this->rules[$field] = new ConstraintsCollection($field, $constraints);
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return count($this->rules) === 0;
    }

    /**
     * @return array<string, ConstraintsCollection>
     */
    public function get(): array
    {
        return $this->rules;
    }
}
