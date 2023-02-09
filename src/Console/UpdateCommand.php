<?php

namespace Cidekar\FeatureFlags\Console;

use Illuminate\Console\Command;
use Cidekar\FeatureFlags\Flags;
use Cidekar\FeatureFlags\Models\Concerns\Flag;

class UpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flag:update
        {name? : The name of the feature flag to update}
        {--active= : Enable a feature\'s flag (i.e., "yes" or "no")}
        {--description= : A description feature flag}
        {--name= : Destory the flage without confirmation }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update a feature flag.';

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

        if(is_null($this->option('active')) &&
            !$this->option('name') &&
            !$this->option('description')){
                $this->info('Noting to update.');
                return;
            }

        $flag = Flag::where('name', $name)->get()->first();
       
        if( !is_null($this->option('active'))  ){
            if($this->option('active') == 'yes' ||
            $this->option('active') ==  'no')
            {
                $flag->active = $this->option('active') == 'yes' ? 1 : 0;
            } 
            else 
            {
                $this->warn('Active option only accepts "yes" or "no"');
                return;
            }
        }
        
        if(is_string($this->option('description'))){
            $flag->description = $this->option('description');
        }

        if(is_string($this->option('name'))){
            $flag->name = $this->option('name');
        }

        $flag->save();
        
        $this->info('Feature flag successfully updated.');
    
        $this->line('<comment>Flag name:</comment> '.$flag->name);
        $this->line('<comment>Flag active:</comment> '.$flag->active);  
        $this->line('<comment>Flag description:</comment> '.$flag->description);

    } 
}
