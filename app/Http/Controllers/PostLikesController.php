<?php

namespace App\Http\Controllers;

use App\Models\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostLikesController extends Controller
{
    //
    
        public function __construct()
        {
            $this->middleware('auth:sanctum');
        }
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $validated = $request->validate([
                'post_id' => ['required'],  
            ]);
            $post = PostLike::create([
                'user_id' => Auth::user()->id,
                'post_id' =>$request->input('post_id'),
            ]);

            return response([
                'success' => true,
                'message' => 'Post Like Has been saved',
                'data' => $post
            ], 200);
        }
    
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(PostLike $postLike)
        {
            //
            $postLike->delete();
            return response([
                'success' => true,
                'message' => 'Post Like Has been deleted',
            ], 200);
        //
        }
        
    
}