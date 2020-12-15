<?php

namespace App\Http\Controllers\ApiWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SectionRepository;
use Validator;
use Illuminate\Http\Response;

class SectionController extends Controller
{
    public function getAll(Request $request)
    {
    	$sectionRepo = new SectionRepository();
    	$section = $sectionRepo->getAll();

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

        $filter_task = !empty($request->filter_task) ? $request->filter_task : null;


    	$sectionRepo = new SectionRepository();
    	$section = $sectionRepo->getById($request->id, $filter_task);

    	return parent::successResponse("", $section);
    }

    public function save(Request $request)
    {
    	$validator = Validator::make($request->all(), [ 
            'section_name' => 'required',
        ]);

        if ($validator->fails()) {
        	return parent::failResponse($validator->errors()->first(), $validator->errors(), Response::HTTP_BAD_REQUEST);
        }

    	$sectionRepo = new SectionRepository();
        $id = !empty($request->get('id')) ? $request->get('id') : null;

        if (!empty($id)) {
        	$section = $sectionRepo->update($id, [
        		'section_name' => $request->section_name
        	]);
        }else{
	    	$section = $sectionRepo->create([
	    		'section_name' => $request->section_name
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

    	$sectionRepo = new SectionRepository();
    	$section = $sectionRepo->delete($request->id);

    	return parent::successResponse("", $section);
    }
}
