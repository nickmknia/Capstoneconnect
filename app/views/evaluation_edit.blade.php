@extends('layouts.master')

@section('title')
@parent
@stop
@section('stylesheets')
{{ HTML::style('css/redmond/jquery-ui-1.10.4.custom.css') }}
@stop
@section('head')
{{ HTML::script('js/jquery-ui-1.10.4.custom.js') }}
@stop
@section('header')
Edit Evaluation
@stop

@section('content')
	{{ Form::open(        
	     array('url' => URL::route('evaluation.update',$eval->id),
	                'role' => 'form', 'method' => 'patch'))}}
	    @for($i = 1; $i <= 10; $i++)
	    	<?php $q = 'q'.$i; ?>
	        <div class="form group">
		        {{ Form::label('q'.$i, 'Question '.$i, array('class' => 'control-label col-sm-2'))}}
		        <div class="col-sm-10">
			        {{ Form::text($q,$eval->$q,array('class' => 'form-control', 'placeholder' => 'enter question'))}}
		        </div>
	        </div>
	        <br><br><br>
	    @endfor
	    <div class="form group">
	    	{{ Form::label('close_at', 'Closing Date', array('class' => 'control-label col-sm-2')) }}
	    	<div class="col-sm-3 col-offset-sm-8">
	    		{{ Form::text('close_at',$eval->close_at,array('class' => 'form-control', 'id' => 'date'))}}
	    	</div>
	    	<br><br><br>
	    <div class="form group">
	        {{ Form::submit('Update Evaluation', array('class'=>'btn btn-default', 'data-toggle' => 'tooltip','data-placement' => 'top', 'title' => 'Click here to create a new evaluation')) }}
	    </div>
	{{ Form::close() }}
	<br>
	{{Form::open(array('url' => URL::route('evaluation.destroy',$eval->id),
	                'role' => 'form', 'method' => 'delete'))}}
    {{ Form::submit('Delete Evaluation', array('class'=>'btn btn-default', 'data-toggle' => 'tooltip','data-placement' => 'top', 'title' => 'Click here to create a delete an evaluation')) }}
    {{Form::close()}}

	<script>$('#date').datepicker();</script>
@stop