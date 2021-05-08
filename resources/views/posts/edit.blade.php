@extends('adminMain')

@section('title', '| Edit Blog Post')
@section('stylesheets')
<!--Select2-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

@endsection
@section('content')

	<div class="row">

	<div class="col-md-8">
		{!! Form::model($post, ['route'=>['posts.update', $post->id], 'method'=>'PUT', 'files' => true]) !!} <!--We have to explicitly mention the method type because default is POST and the update expects a PUT or PATCH-->

		{{ Form::label('title', 'Title: ') }}
		{{ Form::text('title', null, ['class' => 'form-control form-control-lg']) }}
		{{ Form::label('slug', 'Slug: ', ['class'=>'form-spacing-top']) }}
		{{ Form::text('slug', null, ['class' => 'form-control']) }}
		{{ Form::label('featured_image', 'Update Featured Image: ', ['class'=>'form-spacing-top']) }}
		{{ Form::file('featured_image', ['class' => 'form-control']) }}
		{{ Form::label('category_id', 'Change Category To: ', ['class' => 'form-spacing-top']) }}
		{{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
		{{ Form::label('tags', 'Tags: ', ['class' => 'form-spacing-top']) }}
		{{ Form::select('tags[]', $tags, null, ['class' => 'select2-multip form-control', 'multiple' => 'multiple']) }}
		{{ Form::label('body', 'Post Body: ', ['class'=>'form-spacing-top']) }}
		{{ Form::textarea('body', null, ['class' => 'form-control']) }}
	</div>

	<div class="col-md-4">
		<div class="card card-body bg-light">
			<dl class="container row">
				<dt>Created At: &nbsp;</dt>
				<dd>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</dd>
			</dl>

			<dl class="container row">
				<dt>Last Updated: &nbsp;</dt>
				<dd>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</dd>
			</dl>
			<hr>
			<div class="row justify-content-around">
				<div class="">
					<!--This creates an anchor tag-->
					{!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}
				</div>
				<div class="">
					{{ Form::submit('Save Changes', ['class'=>'btn btn-success btn-block']) }}



				</div>
			</div>
		</div>
	</div>
	{!! Form::close() !!}
</div>

@stop
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
	tinymce.init({
		selector:'textarea',
		plugins: 'link lists emoticons image',
		menubar: false,
		extended_valid_elements: 'blockquote'
	});

	$(document).ready(function() {
		$('select.select2-multip').select2();
	});
</script>
@stop
