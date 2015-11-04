<?php

namespace Hechoenlaravel\JarvisFoundation\Flows;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Step
 * @package Modules\Flows\Entities
 */
class Step extends Model
{

    /**
     * @var string
     */
    public $table = "fl_flows_steps";

    /**
     * The flow this step belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flow()
    {
        return $this->belongsTo(Flow::class);
    }

    /**
     * The possible transitions from this step
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transitions()
    {
        return $this->hasMany(Transition::class, 'step_from_id');
    }

}