@extends('main')

@section('title', "| $tag->name Tag")


@section('content')

<div class="row">
  <div class="col-md-8">
    <h2> {{ $tag->name }} Tag <small class="h5"> {{ $tag->posts()->count() }} Posts</small></h2>
  </div>
  <div class="col-md-2">
    <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary float-right  btn-block">Edit</a>
  </div>
  <div class="col-md-2">
    {!! Form::open(['route'=>['tags.destroy', $tag->id], 'method'=>'DELETE']) !!}

    {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-block']) !!}

    {!! Form::close() !!}
  </div>
</div>
<div class="row" style="margin-top: 30px;">
  <div class="col-md-12">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Title</th>
          <th>Tags</th>
          <th>

          </th>
        </tr>
      </thead>
      <tbody>
        @foreach($tag->posts as $post)
        <tr>
          <th>{{ $post->id }}</th>
          <td>{{ $post->title }}</td>
          <td>
            @foreach($post->tags as $tag)
            <span class="badge badge-primary">{{ $tag->name }}</span>
            @endforeach
          </td>
          <td>
            <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-light">View</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@stop
