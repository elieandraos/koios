@extends('layouts.default')

@section('applicationMenu')
	{{ $application->renderMenu() }}
@stop

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="pull-left">{{ $application->name }}</div>
			<div class="pull-right">
				<span class="panel-heading-links">
					{{ HTML::linkAction('ApplicationController@edit', 'Edit', [$application->slug], ['class' => '']) }}
					<i class="icon-fixed-width  icon-edit"></i>
				</span>
			</div>
			<div class="clearfix"></div>
		</div> <!-- end heading -->
		<div class="panel-body">
			
			<div role="tabpanel">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active">
				    	<a href="#certificates" aria-controls="certificates" role="tab" data-toggle="tab">
							<i class="icon-fixed-width  icon-key"></i>
				    		Certificates
				    	</a>
				    </li>
				    <li role="presentation">
				    	<a href="#profile" aria-controls="scheduler" role="tab" data-toggle="tab">
				    		<i class="icon-fixed-width  icon-time"></i>
				    		Scheduler
				    	</a>
				    </li>
				    <li role="presentation">
				    	<a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">
				    		<i class="icon-fixed-width  icon-gears"></i>
				    		Settings
				    	</a>
				    </li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="certificates">
				    	...
				    </div>
				    <div role="tabpanel" class="tab-pane" id="scheduler">
				    	...
				    </div>
				    <div role="tabpanel" class="tab-pane" id="settings">
				    	...
				    </div>
				</div>
			</div>

		</div> <!-- end body -->
	</div>
@stop