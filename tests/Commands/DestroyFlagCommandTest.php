<?php

namespace Cidekar\FeatureFlags\Tests\Commands;

use Cidekar\FeatureFlags\Flags;
use Cidekar\FeatureFlags\Tests\TestCase;


class CreateCommandTest extends TestCase
{
    public function test_it_can_delete_console_command_can_warn(){
        
        $this->artisan("flag:destroy")
            ->expectsOutput('You must provide a feature flag name.')
            ->assertExitCode(0);
    }

    public function test_it_can_delete_console_command_can_warn_for_missing_flag(){
        $name = 'FeatureFlag';
        
        $this->artisan("flag:destroy $name")
            ->expectsOutput('This feature flag does not exists in the system.')
            ->assertExitCode(0);
    }

    public function test_it_can_create_a_flag_with_active_option(){
        $name = 'FeatureFlag';
        Flags::create($name);

        $this->artisan("flag:destroy $name")
            ->expectsQuestion('Are you sure you want to delete this feature flag?', 'yes')
            ->assertExitCode(0);
    }
}
