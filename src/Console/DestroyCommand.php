<?php

namespace Cidekar\FeatureFlags\Console;

use Illuminate\Console\Command;
use Cidekar\FeatureFlags\Flags;

class DestroyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flag:destroy
        {name? : The name of the feature flag to destroy}
        {--force : Destory the flage without confirmation }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Destory a feature flag.';

    /**
     * Execute the console command.
     *
     */
    public function handle(): void
    {
        $name = $this->argument('name');

        if(is_null($name)){
            $this->warn('You must provide a feature flag name.');
            return;
        }

        if(!Flags::has($name)){
            $this->warn('This feature flag does not exists in the system.');
            return;
        }

        if(!$this->option('force')){
            if(!$this->confirm('Are you sure you want to delete this feature flag?'))
            return;
        }
            
        Flags::destroy($name);
        
        $this->info('Feature flag successfully destroyed.');
        
    } 
}
