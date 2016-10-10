<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Cases;

class CaseTransformer extends TransformerAbstract
{
    public function transform(Cases $cases)
    {
        return [
        	'id'=> $cases->id,
            'caseno' => $cases->caseno,
            'title' => $cases->title,
            'description' => $cases->description
        ];
    }
}