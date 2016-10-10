<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CasePayments extends Model
{
    //
    protected $fillable = ['cases_id','amount'];

    public function case()
    {
    	# code...
    	return $this->belongsTo('App\Case');
    }
}





