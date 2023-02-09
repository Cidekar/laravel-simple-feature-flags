<?php

namespace Cidekar\FeatureFlags\Console;

use Illuminate\Console\Command;
use Cidekar\FeatureFlags\Flags;

class CreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flag:create
            {--active= : Enable a feature\'s flag (i.e., "yes" or "no")}
            {--description= : A description feature flag}
            {name? : The name of the feature flag}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a feature flag to protect an application\'s route.';

    /**
     * Execute the console command.
     *
     */
    public function handle(): void
    {
        $name = $this->argument('name');
        
        if(!$name){
            $name = $this->ask('What should we name the feature flag?');
        }

        if(Flags::has($name)){
            $this->warn('This feature flag already exists in the system.'  );
            return;
        }

        if(is_null($name)){
            $this->warn('You must provide a name when creating a feature flag.');
            return;
        }

        $active = $this->option('active') ?: 
            $this->choice('Would you like to activate this feature flag and start protecting your routes?', ['no', 'yes'], 1);
           
        $description = $this->option('description');

        $flag = Flags::create($name, $description, $active == 'yes' ? 1 : 0);
        
        $this->info('Feature flag created successfully.');
        $this->line('<comment>Flag name:</comment> '.$flag->name);
        $this->line('<comment>Flag active:</comment> '.$flag->active);        
    } 
}
