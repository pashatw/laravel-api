<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function index(Request $request)
    {
    	return view('pages.dashboard');
    }

    public function section(Request $request)
    {
    	return view('pages.section.index');
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
}
