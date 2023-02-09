<?php

namespace Cidekar\FeatureFlags\Tests\Middleware;

use Cidekar\FeatureFlags\Flags;
use Cidekar\FeatureFlags\Tests\TestCase;
use Cidekar\FeatureFlags\Http\Middleware\CheckForAnyFeatureFlag;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Illuminate\Http\Request;


class FlagsMiddlewareTest extends TestCase
{   
    public function test_it_can_throw_when_flag_is_empty(): void
    {
        $this->expectException(AccessDeniedHttpException::class);

        $request = new Request;

        $middleware = new CheckForAnyFeatureFlag;

        $middleware->handle($request, function($req){}, 'feature-flag');

    }

    public function test_it_can_throw_when_flag_is_active(): void
    {
        $this->expectException(AccessDeniedHttpException::class);

        $name = 'feature-flag';

        Flags::create($name);

        $request = new Request;

        $middleware = new CheckForAnyFeatureFlag;

        $middleware->handle($request, function($req){}, $name);

    }

    public function test_it_can_the_request_down_middleware_stack(): void
    {
        $name = 'feature-flag';

        Flags::create($name, null, 0);

        $request = new Request;

        $middleware = new CheckForAnyFeatureFlag;

        $middleware->handle($request, function($req){
            $this->assertNotNull($req);
        }, $name);

    }
}
