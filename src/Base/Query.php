<?php

namespace Indielab\AutoScout24\Base;

use Indielab\AutoScout24\Client;

abstract class Query
{
    private ?Client $_client = null;

    /**
     * Sets the client instance for the object.
     *
     * @param Client $client The client instance to set.
     * @return self The current instance for method chaining.
     */
    public function setClient(Client $client): self
    {
        $this->_client = $client;

        return $this;
    }

    /**
     * Retrieves the client instance associated with the object.
     *
     * @return Client|null The client instance if set, or null if not set.
     */
    public function getClient(): ?Client
    {
        return $this->_client;
    }
}
