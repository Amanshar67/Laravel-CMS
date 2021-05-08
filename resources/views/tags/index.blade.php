@extends('adminMain')

@section('title', '| All Tags')

@section('content')
<div class="row">
  <div class="col-md-8">
    <h1>Tags</h1>
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tags as $tag)
        <tr>
          <th>{{ $tag->id }}</th>
          <th><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></th>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div><!--end of col-md-8-->
  <div class="col-md-3">
    <div class="card bg-light">
      <div class="card-body">
        {!! Form::open(['route' => 'tags.store', 'method' => 'POST']) !!}
        <h5>New Tag</h5>
        {{ Form::label('name', 'Name:') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
        {{ Form::submit('Create New Tag', ['class' => 'btn btn-primary cattag', 'style' => 'margin-top: 10px']) }}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>


@endsection
