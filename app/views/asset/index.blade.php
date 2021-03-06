@extends('layouts.default')

@section('applicationMenu')
	{{ $application->renderMenu() }}
@stop


@section('content')

	@if (!count($assets))
		<p class="unfortunate">You haven't uploaded any asset yet :(</p>
		{{ HTML::linkAction('AssetController@create', 'Create One Now', [$application->slug], ['class' => 'btn btn-primary centered']) }}
	@else
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">Assets List</div>
				<div class="pull-right">
					<span class="panel-heading-links">
						{{ HTML::linkAction('AssetController@create', 'Create Asset', [$application->slug], ['class' => '']) }}
						<i class="icon-fixed-width  icon-plus-sign"></i>
					</span>
				</div>
				<div class="clearfix"></div>
			</div> <!-- end heading -->
			<div class="panel-body">
					<table class="table table-striped">
					<tr>
						<th>Title</th>
						<th>Date</th>
						<th>Type</th>
						<th>Caption</th>
						<th>Public URL</th>
						<th class="actions">Action</th>
					</tr>
					@foreach($assets as $single_asset)
						@include('asset.partials._list_row', $single_asset)
					@endforeach
				</table>
				<div class="centered">
					{{ $assets->appends(Request::except('page'))->links() }}
				</div>
			</div> <!-- end body -->
		</div>
	@endif
@stop