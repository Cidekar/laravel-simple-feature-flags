<?php

namespace Cidekar\FeatureFlags\Testing;

use Closure;

class FlagFake
{
    public function handle($request, Closure $next, $flags)
    {
       return $next($request);            
    }
}
