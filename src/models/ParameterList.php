<?php

namespace CWMP\Model;

use Illuminate\Database\Eloquent\Model;

class ParameterList extends Model
{
    public function inform()
    {
    	return $this->belongsTo('CWMP\Model\Inform');
    }
}
