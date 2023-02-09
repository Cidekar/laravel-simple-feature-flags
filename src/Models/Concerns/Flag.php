<?php

namespace Cidekar\FeatureFlags\Models\Concerns;

use Illuminate\Database\Eloquent\Model;

class Flag extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'feature_flags';

    /**
     * The guarded attributes on the model.
     *
     * @var array
     */
    protected $guarded = [];

}