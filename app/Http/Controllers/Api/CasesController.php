<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Transformers\CaseTransformer;
use App\Cases;

class CasesController extends BaseController
{
    //
    
	public function index()
	{
	   // $cases = Cases::paginate(5);
	   $cases = Cases::all();

        // return $this->response->paginator($cases, new CaseTransformer);
       return $this->response->array($cases);
	}

	public function show($id)
	{
	    $case = Cases::find($id);

	    if(!$case)
	        throw new NotFoundHttpException; 

	    return $case;
	}

	public function store(Request $request)
	{
	    $case = new Cases;
	 
	    $case->caseno = $request->input('caseno');
	    $case->title = $request->input('title');
	    $case->description = $request->input('description');
	 
	
	    if($case->save())
        	return $this->response->created();
    	else
        	return $this->response->error('could_not_create_case', 500);
	}

	public function update(Request $request, $id)
	{
	    $case = Cases::find($id);
	    if(!$case)
	        throw new NotFoundHttpException;
	    
	    $case->fill($request->all());

	    if($case->save())
	        return $this->response->noContent();
	    else
	        return $this->response->error('could_not_update_case', 500);
	}

	public function destroy($id)
	{

	   $case = Cases::find($id);

	    if(!$case)
	        throw new NotFoundHttpException;

	    if($case->delete())
	        return $this->response->noContent();
	    else
	        return $this->response->error('could_not_delete_case', 500);
	}

}
