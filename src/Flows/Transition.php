<?php

namespace Hechoenlaravel\JarvisFoundation\Flows;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Transition
 * @package Modules\Flows\Entities
 */
class Transition extends Model
{
    /**
     * @var string
     */
    public $table = "fl_flows_steps_transitions";

    /**
     * @var array
     */
    public $fillable = ['flow_id', 'step_from_id', 'step_to_id'];

    /**
     * The flow this transition belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flow()
    {
        return $this->belongsTo(Flow::class);
    }

    /**
     * The step this transition comes from
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function from()
    {
        return $this->belongsTo(Step::class, 'step_from_id');
    }

    /**
     * The step this transition goes to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function to()
    {
        return $this->belongsTo(Step::class, 'step_to_id');
    }
}
