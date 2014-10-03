@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>Create an application</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			 @include('common.form_error_messages', array('errors' => $errors))

			<?php // form fields name should be the same as the db fields for automatic laravel binding ?>
			{{ Form::open(array('route' => 'application.store', 'files' => true)) }}
				@include('application.partials._form')
			{{ Form::close() }}
		</div>
	</div>
@stop