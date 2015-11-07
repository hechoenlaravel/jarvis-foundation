<?php

namespace Hechoenlaravel\JarvisFoundation\Flows;

use Hechoenlaravel\JarvisFoundation\Flows\Transformers\StepTransformer;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;

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
     * @var array
     */
    protected $fillable = ['name', 'description', 'order', 'is_last'];

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

    /**
     * Model Transformed
     * @return \League\Fractal\Scope
     */
    public function transformed()
    {
        $manager = new Manager();
        $resource = new Item($this, new StepTransformer());
        return $manager->createData($resource);
    }

}