@extends('layouts.default')

@section('applicationMenu')
	{{ $application->renderMenu() }}
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>{{ $application->name }} - Create contact form</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-5">
			 @include('common.form_error_messages', array('errors' => $errors))
			{{ Form::open( ['route' => ['application.{application}.contact-forms.store', $application->slug], 'files' => true]) }}
				@include('contact_forms.partials._form')
			{{ Form::close() }}
		</div>
	</div>
@stop