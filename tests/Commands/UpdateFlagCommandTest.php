<?php

namespace Cidekar\FeatureFlags\Tests\Commands;

use Cidekar\FeatureFlags\Flags;
use Cidekar\FeatureFlags\Tests\TestCase;


class UpdateFlagCommandTest extends TestCase
{
    public function test_it_can_update_warns_if_name_is_not_provided(){
        $name = 'FeatureFlag';

        $this->artisan("flag:update")
            ->expectsOutput('You must provide a feature flag name.')
            ->assertExitCode(0);
    }

    public function test_it_can_update_warns_for_unknown_flag(){
        $name = 'FeatureFlag';

        $this->artisan("flag:update $name")
            ->expectsOutput('This feature flag does not exists in the system.')
            ->assertExitCode(0);
    }

    public function test_it_can_update_does_not_update_without_options(){
        $name = 'FeatureFlag';
        Flags::create($name);

        $this->artisan("flag:update $name")
            ->expectsOutput('Noting to update.')
            ->assertExitCode(0);
    }

    public function test_update_with_unknown_active_option_warns(){
        $name = 'FeatureFlag';
        Flags::create($name);

        $this->artisan("flag:update $name --active=true")
            ->expectsOutput('Active option only accepts "yes" or "no"')
            ->assertExitCode(0);
    }

    public function test_update_with_active_option(){
        $name = 'FeatureFlag';
        Flags::create($name);

        $this->artisan("flag:update $name --active=true")
            ->expectsOutput('Active option only accepts "yes" or "no"')
            ->assertExitCode(0);
    }

    public function test_it_can_preform_update_with_description_option(){
        $name = 'FeatureFlag';
        Flags::create($name);

        $this->artisan("flag:update $name --description='Feature flags are cool.'")
            ->assertExitCode(0);
    }

    public function test_it_can_preform_update_with_name_option(){
        $name = 'FeatureFlag';
        Flags::create($name);

        $this->artisan("flag:update $name --name='FlaggedFeature'")
            ->assertExitCode(0);
    }
}
