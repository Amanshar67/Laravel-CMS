@extends('adminMain')

@section('title', '| All Posts')

@section('content')

	<div class="row">
		<div class="col-md-9">
			<h1>All Posts</h1>
			@can('isUser')
			<p>Only user can see this</p>
			@endcan
		</div>
		<div class="col-md-3 mt-2">
			<a href="{{ route('posts.create') }}" class="btn btn-block btn-warning btn-h1-spacing">Create New Post</a>
		</div>
	</div><!--end of .row-->
	<div class="row">
		<div class="col-md-12">
			<table class="table table-index">
				<thead>
					<th>#</th>
					<th>Title</th>
					<th>Body</th>
					<th>Created At</th>
					<th></th>
				</thead>
				<tbody>
					@foreach($posts as $post)
						<tr>
							<th>{{ $post->id }}</th>
							<td>{{ str_limit($post->title, 35) }}</td>
							<td>{{ str_limit(strip_tags($post->body), 50) }}</td>
							<td>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</td>
							<td><a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-primary w-100">View</a> <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary w-100 btn-sm mt-3">Edit</a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div class="center-text">
				{!! $posts->links(); !!}
			</div>
		</div>
	</div>

@stop
