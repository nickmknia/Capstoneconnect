<?php

class AdminToolsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Admin Tools Controller
	|--------------------------------------------------------------------------
	|
	| 
	|
	|
	|
	*/

	// render admin_users.blade.php
	public function makeManageUsers()
	{
		return View::make('admin_users')->with('SuperAdmin','admin@sc.edu');
	}

	// render admin_evals.blade.php
	public function makeManageEvals()
	{
		$openEvals = Evaluation::where('close_at','>=',Carbon::now())->get();
		$closedEvals = Evaluation::where('close_at','<',Carbon::now())->get();
		return View::make('admin_evals', array('openEvals' => $openEvals, 'closedEvals' => $closedEvals));
	}

	public function makeEvalsAbout($id)
	{
		$userid = $id;
		return View::make('admin_evals_about')->with('userid', $id);
	}

	public function makeEvalsBy($id)
	{
		$userid = $id;
		return View::make('admin_evals_by')->with('userid', $id);
	}
	//render evals using id
	public function getUserEvals($id)
	{
		return View::make('admin_evals')->with('userid', $id);
	}

	/*
	public function createQuestionnaire()
	{
		$question1 = Input::get('q1');
		$question2 = Input::get('q2');
		$question3 = Input::get('q3');
		$question4 = Input::get('q4');
		$question5 = Input::get('q5');
		$question6 = Input::get('q6');
		$question7 = Input::get('q7');
		$question8 = Input::get('q8');
		$question9 = Input::get('q9');
		$question10 = Input::get('q10');

		DB::insert("INSERT INTO questions(date_created, question1, question2, question3, question4, question5,
			question6, question7, question8, question9, question10) VALUES (NOW(), '$question1', '$question2', '$question3',
			'$question4', '$question5', '$question6', '$question7', '$question8', '$question9', '$question10')");
		return Redirect::to('admin');
	}*/

	public function addProject()
	{

	}

	public function addEvaluation()
	{
		
	}
}