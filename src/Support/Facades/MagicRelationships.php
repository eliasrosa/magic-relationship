<?php

namespace Magic\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Illuminate\View\Factory
 */
class MagicRelationships extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'magic-relationships';
    }
}
