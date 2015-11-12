<?php

namespace Hechoenlaravel\JarvisFoundation\Support;


/**
 * Class SearchableTrait
 * @package Hechoenlaravel\JarvisFoundation\Support
 */
trait SearchableTrait
{
    /**
     * Make a search able model
     * @param array $data
     */
    public function search(array $data = [])
    {
        foreach($data as $field => $value)
        {
            $method = 'scope'.camel_case($field);
            if(method_exists($this, $method)){
                $this->{$field}($value);
            }else{
                $this->where($field, $value);
            }
        }
        return $this;
    }
}