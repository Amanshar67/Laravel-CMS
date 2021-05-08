<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use Mail;
use Session;


class PagesController extends Controller{

	public function getIndex(){
		$posts = Post::latest()->limit(4)->get();
		return view('pages.welcome')->withPosts($posts);
	}

	public function getAbout(){

		return view('pages.about');
	}

	public function getContact(){
		return view('pages.contact');
	}
	public function postContact(Request $request){

		$this->validate($request, [
			'email' => 'required|email',
			'subject' => 'min:3',
			'message' => 'min:10']);

		$data = array(
			'email' => $request->email,
			'subject' => $request->subject,
			'bodyMessage' => $request->message
		);
        // Laravel automatically creates variable for all keys (so we can
        // use in the view). Ex: $email, $bodyMessage will be created.
		Mail::send('emails.contact', $data, function($message) use ($data){
			$message->from($data['email']);
			$message->to('amanshar67@gmail.com');
			$message->subject($data['subject']);
		});
		Session::flash('success', 'Your Email was Sent!');
		return redirect('/contact');
	}
}
