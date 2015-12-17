<?php

namespace CustomAppName;

use Illuminate\Database\Eloquent\Model;

class Inform extends Model
{
    public function parameterList()
    {
        return $this->hasOne('CustomAppName\ParameterList');
    }
}
