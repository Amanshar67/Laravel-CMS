<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Gate;
use Session;
use Purifier;
use Image;
use Storage;
use App\Category;
use App\Tag;

class PostController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware(function($request, $next){
          if (!Gate::allows('isUser') && !Gate::allows('isAdmin')) {
            return redirect()->route('login');
          }
          return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //the $posts variable stores all posts from DB
        $posts = Post::latest()->paginate(5);

        //return a view and pass abovr variable
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the data
        $this->validate($request, array(    //validate() function is from extended class Controller
            'title'          => 'required|max:255',
            'slug'           => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'author'         => 'required',
            'body'           => 'required',
            'category_id'    => 'required|integer',
            'featured_image' => 'sometimes|image'
        ));

        //Storing in the database
        $post = new Post;   //Creating new instance of post

        $post->title = $request->title; //Saves the title and body to $post
        $post->slug = $request->slug;
        $post->body = Purifier::clean($request->body);
        $post->author = $request->author;
        $post->category_id = $request->category_id;

        //save our image
        if ($request->hasFile('featured_image')) {
          $image = $request->file('featured_image');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('images/' . $filename);
          Image::make($image)->save($location);
          $post->image = $filename;
        }

        $post->save();          //Inserts the title and body to the DB
        $post->tags()->sync($request->tags, false);

        $request->session()->flash('success', 'The blog post was successfully save!');

        //redirect to show page

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);           //finds the item by primary id and all the data retrieved from DB is stored in the $post variable
        return view('posts.show')->withPost($post); //the withPost helps to use the data of $post in our view by using $post
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $categories = Category::all();
        // $cats = [];
        // foreach ($categories as $category) {
        //   $cats[$category->id] = $category->name;
        // }
        $cats = Category::pluck('name', 'id');
        $tags = Tag::pluck('name', 'id');
        $post = Post::find($id);
        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

            $this->validate($request, array(
                'title' => 'required|max:255',
                'slug' => "required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
                'body' => 'required',
                'category_id' => 'required|integer',
                'featured_image' => 'image'
            ));

        //save the data to the DB
    $post = Post::find($id);
        $post->title = $request->input('title'); //This means to grab the data from input with attribute 'title'
        $post->slug = $request->input('slug');
        $post->body = Purifier::clean($request->input('body'));
        $post->category_id = $request->input('category_id');

        if ($request->hasFile('featured_image')) {
          //add the new photo
          $image = $request->file('featured_image');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('images/' . $filename);
          Image::make($image)->save($location);
          $oldFilename = $post->image;
          //update the database
          $post->image = $filename;
          //delete the old photo
          Storage::delete($oldFilename);
        }
        $post->save();

        $post->tags()->sync($request->tags);
        //set flash data with success message
        $request->session()->flash('success', 'The blog post was successfully saved.');

        //redirect with flash data to posts.show
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete the post
        $post = Post::find($id);
        $post->tags()->detach(); //deletes any reference of post and tags
        $post->delete();

        Session::flash('success', 'The post has been successfully deleted.');
        return redirect()->route('posts.index');
    }
}
