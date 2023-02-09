<?php

namespace Cidekar\FeatureFlags\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Arr;

class MissingFlagException extends AuthorizationException
{
    /**
     * The flags that the user did not have.
     *
     * @var array
     */
    protected $flags;

    /**
     * Create a new missing scope exception.
     *
     * @param  array|string  $flags
     * @param  string  $message
     * @return void
     */
    public function __construct($flags = [], $message = 'Invalid flag(s) provided.')
    {
        parent::__construct($message);

        $this->flags = Arr::wrap($flags);
    }

    /**
     * Get the flags that the user did not have.
     *
     * @return array
     */
    public function flags()
    {
        return $this->flags;
    }
}
