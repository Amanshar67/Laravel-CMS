@extends('adminMain')

@section('title', '| All Categories')

@section('content')
<div class="row">
  <div class="col-md-8">
    <h1>Categories</h1>
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $category)
        <tr>
          <th>{{ $category->id }}</th>
          <th>{{ $category->name }}</th>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div><!--end of col-md-8-->
  <div class="col-md-3">
    <div class="card bg-light">
      <div class="card-body">
        {!! Form::open(['route' => 'categories.store', 'method' => 'POST']) !!}
        <h5>New Category</h5>
        {{ Form::label('name', 'Name:') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
        {{ Form::submit('Create New Category', ['class' => 'btn btn-primary cattag', 'style' => 'margin-top: 10px']) }}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>


@endsection
