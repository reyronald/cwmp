<?php

namespace CWMP\Model;

use Illuminate\Database\Eloquent\Model;

class Inform extends Model
{
    public function parameterList()
    {
        return $this->hasOne('CWMP\Model\ParameterList');
    }
}
