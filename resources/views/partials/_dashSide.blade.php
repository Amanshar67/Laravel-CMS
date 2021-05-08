<ul class="list-group sideDash">
  <li class="list-group-item {{Request::is('posts/create')?"active" :""}}" ><a href="{{ route('posts.create') }}">Create A Post</a></li>
  <li class="list-group-item {{Request::is('posts')?"active" :""}}"><a href="{{ route('posts.index') }}">View Posts</a></li>
  <li class="list-group-item"><a href="{{ route('categories.index') }}">Categories</a></li>
  <li class="list-group-item"><a href="{{ route('tags.index') }}">Tags</a></li>
</ul>
