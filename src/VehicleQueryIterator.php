<?php

namespace Indielab\AutoScout24;

use Countable;
use ReturnTypeWillChange;

class VehicleQueryIterator implements \Iterator, Countable
{
    private array $_data;

    public function __construct(array $data)
    {
        $this->_data = $data;
    }

    public int $totalResultCount;

    public int $totalPages;

    public int $currentPage;

    public int $currentPageResultCount;

    public function count(): int
    {
        return count($this->_data);
    }

    public function rewind(): void
    {
        reset($this->_data);
    }

    /**
     * @return Vehicle Returns the Vehicle Object.
     */
    public function current(): Vehicle
    {
        return new Vehicle(current($this->_data));
    }

    #[ReturnTypeWillChange] public function key() // Todo: Signature needs to be adjusted from php 8.1 onwards
    {
        return key($this->_data);
    }

    public function next(): void
    {
        next($this->_data);
    }

    public function valid(): bool
    {
        return key($this->_data) !== null;
    }
}
