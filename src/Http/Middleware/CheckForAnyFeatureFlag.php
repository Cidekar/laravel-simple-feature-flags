<?php

namespace Cidekar\FeatureFlags\Http\Middleware;

use Closure;

use Cidekar\FeatureFlags\Models\Concerns\Flag;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CheckForAnyFeatureFlag
{
    public function handle($request, Closure $next, $flags)
    {
        
        $flag = Flag::where('name',  $flags)->get();    
        
        if($flag->isNotEmpty() && $flag->first()->active == 0)
        {
            return $next($request);            
        }
        
        throw new AccessDeniedHttpException();    
    }
}
