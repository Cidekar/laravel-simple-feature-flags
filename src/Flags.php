<?php

namespace Cidekar\FeatureFlags;

use Cidekar\FeatureFlags\Models\Concerns\Flag;
use Cidekar\FeatureFlags\Exceptions\MissingFlagException;
use Cidekar\FeatureFlags\Testing\FlagFake;
use Exception;


class Flags
{
    public static function create($name, $description = null, $active = 1):Flag
    {
        $flag = new Flag([
            'name' => $name,
            'description' => $description,
            'active' => $active
        ]);

        $flag->save();

        return $flag;
    }

    public static function update($oldName, $name = null, $description = null, $active = null):Flag
    {
        $flag = Flag::where('name', $oldName)->get();

        if($flag->isEmpty())
        {
            throw new MissingFlagException($oldName);
        }

        $flag = $flag->first();

        $flag->name = $name ?? $flag->name; 
        $flag->description = $description ?? $flag->description;
        $flag->active = $active ?? $flag->active;
        
        $flag->update();

        return $flag;
    }

    public static function destroy($name):void
    {
        $flag = Flag::where('name', $name)->get();

        if($flag->isEmpty())
        {
            throw new MissingFlagException($name);
        }

        $flag->first()->delete();
    }

    public static function has($name):Bool
    {
        return self::get($name)->count() > 0;
    }

    public static function get($name):\Illuminate\Database\Eloquent\Collection
    {
        return Flag::where('name', $name)->get();
    }

    public static function fake()
    {
        app('router')->aliasMiddleware('flags', FlagFake::class);
    }
}
