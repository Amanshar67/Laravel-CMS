@extends('main')

@section('title', '| Blog')

@section('content')

	<div class="row">
		<div class="col-md-12">
			<h1>Blog</h1>
		</div>
	</div>

	@foreach ($posts as $post)
	<div class="row blog-index">
		<div class="col-md-4">
			<img src="{{ asset('images/' . $post->image) }}" class="img-fluid" />
		</div>
		<div class="col-md-8">
			<h2> {{ $post->title }} </h2>
			<p class="date">Published Date: {{ date('M j, Y', strtotime($post->created_at)) }}</p>
			<p> {{ str_limit(strip_tags($post->body), 300) }} </p>
			<a href="{{ url('blog/'.$post->slug) }}" class="btn btn-primary">Read More</a>
		</div>
	</div>
	@if (!$loop->last)
	<hr>
	@endif
	@endforeach
		<div class="col-md-12">
			<div class="text-xs-center">
				{!!$posts->links();!!}
			</div>
		</div>

@stop
