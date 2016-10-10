<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    //

    protected $fillable = ['caseno','title','description'];

    public function payments()
    {
    	return $this->hasMany('App\Casepayments');
    }
}
