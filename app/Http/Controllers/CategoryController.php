<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Gate;

class CategoryController extends Controller
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
        //display view for categories
        $categories = Category::all();

        //option to create new category
        return view('categories.index')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //saves the category and redirects to index
        $this->validate($request, array(
          'name' => 'required|max:255'
        ));

        $category = new Category;
        $category->name = $request->name;

        $category->save();

        $request->session()->flash('success', 'The Category was successfully created!');

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
