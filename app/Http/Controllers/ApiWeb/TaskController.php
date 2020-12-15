<?php

namespace App\Http\Controllers\ApiWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\TaskRepository;
use Validator;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function getAll(Request $request)
    {
        $filter_state = !empty($request->filter_state) ? $request->filter_state : null;
        
    	$sectionRepo = new TaskRepository();
    	$section = $sectionRepo->getAll($filter_state);

    	return parent::successResponse("", $section);
    }

    public function getById(Request $request)
    {
    	$validator = Validator::make($request->all(), [ 
            'id' => 'required',
        ]);

        if ($validator->fails()) {
        	return parent::failResponse($validator->errors()->first(), $validator->errors(), Response::HTTP_BAD_REQUEST);
        }

    	$sectionRepo = new TaskRepository();
    	$section = $sectionRepo->getById($request->id);

    	return parent::successResponse("", $section);
    }

    public function save(Request $request)
    {
    	$validator = Validator::make($request->all(), [ 
            'section_id' => 'required|exists:section,id',
            'task_name' => 'required',
        ]);

        if ($validator->fails()) {
        	return parent::failResponse($validator->errors()->first(), $validator->errors(), Response::HTTP_BAD_REQUEST);
        }

    	$sectionRepo = new TaskRepository();
        $id = !empty($request->get('id')) ? $request->get('id') : null;

        if (!empty($id)) {
        	$section = $sectionRepo->update($id, [
                'section_id' => $request->section_id,
        		'task_name' => $request->task_name,
                'task_state' => $request->task_state
        	]);
        }else{
	    	$section = $sectionRepo->create([
                'section_id' => $request->section_id,
                'task_name' => $request->task_name,
                'task_state' => $request->task_state
	    	]);
        }

    	return parent::successResponse("", $section);
    }

    public function delete(Request $request)
    {
    	$validator = Validator::make($request->all(), [ 
            'id' => 'required',
        ]);

        if ($validator->fails()) {
        	return parent::failResponse($validator->errors()->first(), $validator->errors(), Response::HTTP_BAD_REQUEST);
        }

    	$sectionRepo = new TaskRepository();
    	$section = $sectionRepo->delete($request->id);

    	return parent::successResponse("", $section);
    }
}
