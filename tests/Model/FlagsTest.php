<?php

namespace Cidekar\FeatureFlags\Tests\Unit;

use Cidekar\FeatureFlags\Models\Concerns\Flag;
use Cidekar\FeatureFlags\Tests\TestCase;

class FlagTest extends TestCase
{   
    public function test_it_can_create_a_flag(): void
    {
        $name = 'Feature';
        
        $flag = new Flag();

        $this->assertInstanceOf(Flag::class, $flag);
    }
}
