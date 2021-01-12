<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TweetController extends Controller
{
   public function  index() {
       $tweets = Tweet::with([
           'user' => function($query) {
                $query->withCount([
                    'followers as is_followed' => function($query) {
                    $query->where('follower_id', auth()->user()->id);
                    }
                ])
                ->withCasts(['is_followed' => 'boolean'])
                ;
           }
       ])
           ->orderBy('created_at','DESC')
           ->get();
     //  dd($tweets);
       return Inertia::render('Tweets/Index', [
           'tweets' => $tweets
       ]);
   }

   public function store(Request $request) {
       $request->validate([
           'content' =>['required', 'max:200'],
           'user_id' =>['exists:users.id'],
       ]);

       Tweet::create([
           'content' => $request->input('content'),
           'user_id' => auth()->user()->id,
       ]);

       return Redirect::route('tweets.index');
   }

    public function follows(User $user) {
     /*
        auth()->user()->followings()->attach($user->id);
        return Redirect::route('tweets.index');
     */
        Auth::user()->followings()->attach($user);

        return redirect()->back();
    }

    public function unfollows(User $user) {
       /* auth()->user()->followings()->detach($user->id);
        return Redirect::route('tweets.index');
       */
        Auth::user()->followings()->detach($user);

        return redirect()->back();
    }

    public function followings() {
       $followings = Tweet::with('user')
       ->whereIn('user_id', auth()->user()->followings->pluck('id'))
           ->orderBy('created_at', 'DESC')
           ->get()
       ;
       //dd($followings);
       return Inertia::render('Tweets/Followings', ['followings' => $followings]);
    }

    public function delete(Request $request)
    {

        if ($request->has('id')) {

            Tweet::find($request->input('id'))->delete();

            return redirect()->back();

        }
    }

    public function profile(User $user) {
       $profileUser = $user->loadCount([
           'followings as is_following_you' =>
               function ($q) {
           $q->where('following_id', auth()->user()->id)
           ->withCasts(['is_following_you' => 'boolean']);


               },
           'followings as is_followed' =>
               function ($q) {
                   $q->where('following_id', auth()->user()->id)
                       ->withCasts(['is_followed' => 'boolean']);
                       }
       ]);

       $tweets = $user->tweets;

       return Inertia::render('Tweets/Profile', [
           'profileUser' => $profileUser,
           'tweets' => $tweets
       ] );
    }
}
