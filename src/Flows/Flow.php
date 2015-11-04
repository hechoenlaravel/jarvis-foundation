<?php

namespace Hechoenlaravel\JarvisFoundation\Flows;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Flow
 * @package Modules\Flows\Entities
 */
class Flow extends Model{

    /**
     * @var string
     */
    public $table = "fl_flows";

    /**
     * the fillable columns
     * @var array
     */
    protected $fillable = ['name', 'description', 'active'];

    /**
     * The steps
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    /**
     * The transitions
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transitions()
    {
        return $this->hasMany(Transition::class);
    }

}