<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function index(Request $request)
    {
    	return view('pages.dashboard');
    }

    // section
    public function section(Request $request)
    {
    	return view('pages.section.index');
    }

    public function sectionDetail(Request $request, $id)
    {
        $data = [];
        $data['id'] = $id;
        return view('pages.section.detail', $data);
    }

    public function sectionAdd(Request $request)
    {
    	return view('pages.section.add');
    }

    public function sectionEdit(Request $request, $id)
    {
    	$data = [];
    	$data['id'] = $id;
    	return view('pages.section.add', $data);
    }

    // task
    public function task(Request $request)
    {
    	return view('pages.task.index');
    }

    public function taskAdd(Request $request)
    {
    	return view('pages.task.add');
    }

    public function taskEdit(Request $request, $id)
    {
    	$data = [];
    	$data['id'] = $id;
    	return view('pages.task.add', $data);
    }
}
