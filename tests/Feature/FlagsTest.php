<?php

namespace Cidekar\FeatureFlags\Tests\Feature;

use Cidekar\FeatureFlags\Flags;
use Cidekar\FeatureFlags\Tests\TestCase;
use Cidekar\FeatureFlags\Exceptions\MissingFlagException;

class FlagTest extends TestCase
{   
    public function test_it_can_create_a_flag(): void
    {

        $name = 'Feature';
        $flag = Flags::create($name);

        $this->assertEquals($name, $flag->name);
        
        $flag->delete();
    }

    public function test_it_can_define_a_description(): void
    {
        $name = 'Feature';
        $description = "A flag description.";
        
        $flag = Flags::create($name, $description);

        $this->assertEquals($description, $flag->description);

        $flag->delete();
    }

    public function test_it_can_define_flag_as_active(): void
    {
        $name = 'Feature';
        $active = 1;
        
        $flag = Flags::create($name, null, $active);

        $this->assertEquals($active, $flag->active);

        $flag->delete();
    }

    public function test_it_can_update_a_flag(): void
    {
        $name = 'Feature';
        $rename = 'Feature-Flag';
        
        $flag = Flags::create($name);
        $this->assertEquals($name, $flag->name);
        $updated = Flags::update($name, $rename);

        $description = "A flag description.";
        $updated = Flags::update($rename, null, $description);
        $this->assertEquals($description, $updated->description);

        $active = 0;
        $updated = Flags::update($rename, null, null, $active);
        $this->assertEquals($active, $updated->active);
        
        $updated->delete();
    }

    public function test_update_unknown_flag_throws(): void
    {
        $this->expectException(MissingFlagException::class);

        $name = 'Feature';
        
        $flag = Flags::create($name);

        Flags::update("{$name}-flag");

        $flag->delete();
    }

    public function test_it_can_delete_a_flag(): void
    {
        $name = 'Feature';
        
        Flags::create($name);

        $this->assertNull(Flags::destroy($name));

        $this->assertTrue(Flags::get('name', $name)->isEmpty());
    }

    public function test_delete_unknown_flag_throws(): void
    {
        $this->expectException(MissingFlagException::class);

        $name = 'Feature';
        
        Flags::destroy($name);
    }

    public function test_it_has_flag(): void
    {
        $name = 'Feature';
        
        $flag = Flags::create($name);

        $this->assertTrue(Flags::has($name));

        $this->assertNotTrue(Flags::has("{$name}-feature"));
    }


    public function test_it_can_get_flag(): void
    {
        $name = 'Feature';
        
        $flag = Flags::create($name);

        $this->assertTrue(Flags::get($name)->isNotEmpty());
    }

    public function test_it_can_fake_middleware_for_testing(): void
    {
        Flags::fake();
        $middleware = app('router')->getMiddleware();

        $this->assertArrayHasKey('flags', $middleware);

        $this->assertArrayHasKey('flags', $middleware);

        $this->assertContains('Cidekar\FeatureFlags\Testing\FlagFake', $middleware);
    }
}
