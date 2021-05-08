@extends('adminMain')

@section('title', '| View Post')

@section('content')

<div class="row">
	<div class="col-md-8">
		<h1>{{ $post->title }}</h1>
		<p class="lead">{!! $post->body !!}</p>
		<hr />
		<div class="tags">
			@foreach($post->tags as $tag)
			<span class="badge badge-secondary">{{ $tag->name }}</span>
			@endforeach
		</div>

		<div id="backend-comments" style="margin-top: 50px;">
				<h3>Comments <small>{{ $post->comments()->count() }} total</small></h3>

				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Comment</th>
							<th width="70px"></th>
						</tr>
					</thead>

					<tbody>
						@foreach ($post->comments as $comment)
						<tr>
							<td>{{ $comment->name }}</td>
							<td>{{ $comment->email }}</td>
							<td>{{ $comment->comment }}</td>
							<td>
								<!-- Button trigger modal -->
									<button class="btn btn-danger" data-commentId={{$comment -> id}} data-toggle="modal" data-target="#delete"><span class="fas fa-trash-alt"></span></button>
								<!-- <a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-xs btn-danger"><span class="fas fa-trash-alt"></span></a> -->
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
	</div>

@if(isset($comment->id))
	<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Delete Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<form action="{{route('comments.destroy',$comment->id)}}" method="post">
	      		{{method_field('delete')}}
	      		{{csrf_field()}}
		      <div class="modal-body">
					<p class="text-center">
						Are you sure you want to delete this?
					</p>
		      		<input type="hidden" name="comment_id" id="comment_id" value="">

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
		        <button type="submit" class="btn btn-danger">Yes, Delete</button>
		      </div>
	      </form>
      </div>
    </div>
  </div>
</div>
@endif

	<div class="col-md-4">
		<div class="card card-body bg-light">
			<dl class="container row">
				<label>Url: </label>
				<p><a href="{{ url('blog/'.$post->slug) }}">{{ url('blog/'.$post->slug) }}</a></p>
			</dl>

			<dl class="container row">
				<label>Category: &nbsp;</label>
				<p>{{ $post->category->name }}</p>
			</dl>

			<dl class="container row">
				<label>Author: &nbsp;</label>
				<p>{{ $post->author }}</p>

			</dl>

			<dl class="container row">
				<label>Created At: &nbsp;</label>
				<p>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</p>
			</dl>

			<dl class="container row">
				<label>Last Updated: &nbsp;</label>
				<p>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</p>
			</dl>
			<hr>
			<div class="row">
				<div class="col-sm-6">
					<!--This creates an anchor tag-->
					{!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-info btn-block')) !!}
				</div>
				<div class="col-sm-6">
					{!! Form::open(['route'=>['posts.destroy', $post->id], 'method'=>'DELETE']) !!}

					{!! Form::submit('Delete', ['class'=>'btn btn-danger btn-block']) !!}

					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('scripts')
<script>

$('#delete').on('show.bs.modal', function (event) {
		 var button = $(event.relatedTarget)
		 var comment_id = button.data('commentId')
		 var modal = $(this)
		 modal.find('.modal-body #comment_id').val(comment_id);
})
</script>
@endsection
