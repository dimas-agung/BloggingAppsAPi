<?php

namespace App\Http\Controllers;

use App\Models\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCommentsController extends Controller
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
                'comment' => ['required'],  
            ]);
            $post = PostComment::create([
                'user_id' => Auth::user()->id,
                'post_id' =>$request->input('post_id'),
                'comment' =>$request->input('comment'),
            ]);

            return response([
                'success' => true,
                'message' => 'Post Comment Has been saved',
                'data' => $post
            ], 200);
        }
        public function update(Request $request,PostComment $postComment)
        {
            $validated = $request->validate([
                'comment' => ['required'],  
            ]);
            $post = $postComment->update($validated);

            return response([
                'success' => true,
                'message' => 'Post Comment Has been saved',
                'data' => $post
            ], 200);
        }
    
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(PostComment $postComment)
        {
            //
            $postComment->delete();
            return response([
                'success' => true,
                'message' => 'Post Comment Has been deleted',
            ], 200);
        //
        }
    
}