<?php

namespace Cidekar\FeatureFlags\Tests\Commands;

use Cidekar\FeatureFlags\Tests\TestCase;


class CreateFlagCommandTest extends TestCase
{
    public function test_it_can_create_via_console_command(){
        $name = 'FeatureFlag';

        $this->artisan("flag:create")
            ->expectsQuestion('What should we name the feature flag?', $name)
            ->expectsQuestion('Would you like to activate this feature flag and start protecting your routes?', 0)
            ->assertExitCode(0);
    }

    public function test_it_can_create_a_flag_with_description_option(){
        $name = 'FeatureFlag';
        $description = 'Feature flags are cool.';

        $this->artisan("flag:create --description='{$description}'")
            ->expectsQuestion('What should we name the feature flag?', $name)
            ->expectsQuestion('Would you like to activate this feature flag and start protecting your routes?', 0)
            ->assertExitCode(0);
    }

    public function test_it_can_create_a_flag_with_active_option(){
        $name = 'FeatureFlag';
        $active = 'yes';

        $this->artisan("flag:create --active='{$active}'")
            ->expectsQuestion('What should we name the feature flag?', $name)
            ->assertExitCode(0);
    }

    public function test_it_can_create_a_flag_with_name_argument(){
        $name = 'FeatureFlag';
        $active = 'yes';

        $this->artisan("flag:create $name")
            ->expectsQuestion('Would you like to activate this feature flag and start protecting your routes?', 0)
            ->assertExitCode(0);
    }

    public function test_it_can_programmatically_create_a_flag(){
        $name = 'FeatureFlag';
        $active = 'yes';

        $this->artisan("flag:create $name --active='{$active}'")
            ->assertExitCode(0);
    }
}
