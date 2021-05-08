@extends('main')

@section('title', '| Homepage')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="jumbotron">
          <div class="row">
            @foreach($posts as $post)
            @if ($loop->first)
            <div class="col-md-6">
            <h1>{{ $post->title }}</h1>
            <p class="lead">{{ str_limit(strip_tags($post->body), 300) }}</p>
            <a href="{{url('blog/'.$post->slug)}}" class="btn btn-primary">Read More</a>
            <div class="social"><span>Share this post: </span>
              <a href="http://www.facebook.com/sharer.php?u={{ url('blog/'.$post->slug) }}" target="_blank"><i class="fab fa-facebook-square"></i></a>
              <a href="https://twitter.com/share?url={{ url('blog/'.$post->slug) }}&amp;text={{ $post->title }}" target="_blank"><i class="fab fa-twitter-square"></i></a>
              <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ url('blog/'.$post->slug) }}" target="_blank"><i class="fab fa-linkedin"></i></a>
              <a href="<https://plus.google.com/share?url={{ url('blog/'.$post->slug) }}" target="_blank"><i class="fab fa-google-plus-square"></i></a>
            </div>
            </div>
            <div class="col-md-5 offset-md-1">
              <img src="{{ asset('images/' . $post->image) }}" class="img-fluid" />
            </div>
          </div>
        </div> <!--jumbotron ends here-->

      <div class="row greyhome">


            @else
            <div class="col-md-4">
            <div class="post">
                <img src="{{ asset('images/' . $post->image) }}" class="img-fluid" />
                <div class="text-content">
                  <h4>{{ $post->title }}</h4>
                  <p class="text-center">
                    <i class="fas fa-clock"></i> {{ date('M j, Y', strtotime($post->created_at)) }}
                  </p>
                  <p>{{ str_limit(strip_tags($post->body), 100) }}</p>
                  <a href="{{url('blog/'.$post->slug)}}" class="btn btn-primary">Read More</a>
                </div>
            </div>

            </div>
            @endif
            @endforeach

    </div>
</div>
</div><!--end of .row-->
@endsection
