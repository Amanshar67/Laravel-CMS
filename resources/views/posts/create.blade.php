@extends('adminMain')

@section('title', '| Create New Post')
@section('stylesheets')
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />


@endsection
@section('content')

<div class="row">
	<div class="col-md-8 offset-md-2">
		<h2>Create New Post</h2>
		<hr>
		{!! Form::open(array('route'=>'posts.store', 'files' => true)) !!}
		{{ Form::label('title', 'Title: ') }}
		{{ Form::text('title', null, ['class' => 'form-control'])}}
		{{ Form::label('slug', 'Slug: ') }}
		{{ Form::text('slug', null, ['class' => 'form-control'])}}
		{{ Form::label('category_id', 'Category: ') }}
		<select class="form-control" name="category_id">
			@foreach($categories as $category)
				<option value="{{ $category->id }}">
					{{ $category->name }}
				</option>
			@endforeach
		</select>
		{{ Form::label('tags', 'Tag: ') }}
		<select class="form-control select2-multip" name="tags[]" multiple="multiple">
			@foreach($tags as $tag)
				<option value="{{ $tag->id }}">
					{{ $tag->name }}
				</option>
			@endforeach
		</select>
		{{ Form::label('featured_image', 'Upload Featured Image: ', ['class' => 'form-spacing-top']) }}
		{{ Form::file('featured_image', ['class' => 'form-control']) }}
		{{ Form::label('author', 'Author: ', ['class' => ' form-spacing-top']) }}
		<input name="author" id="author" class="form-control" value="{{Auth::user()->name}}" readonly/>
		{{ Form::label('body', 'Post Body: ', ['class' => 'form-control']) }}
		{{ Form::textarea('body', null, array('class' => 'form-control', 'id' => 'editor'))}}
		{{ Form::submit('Create Post', array('class' => 'btn btn-success btn-block btn-lg', 'style' => 'margin-top: 20px'))}}
		{!! Form::close() !!}
	</div>
</div>

@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
	tinymce.init({
		selector:'textarea',
		plugins: 'link lists emoticons',
		extended_valid_elements: 'blockquote'
	});

	$(document).ready(function() {
		$('select.form-control.select2-multip').select2();
	});
</script>
@stop
