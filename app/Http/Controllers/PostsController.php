<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //
        public function __construct()
        {
            $this->middleware('auth:sanctum');
        }
        public function index(Request $request) {
            
            try {
                //code...
                $id = $request->input('id');
                $status = $request->input('status');
                $user_id = $request->input('user_id');
                $date = $request->input('date');
                if ($id) {
                    $post = Post::find($id);
                    
                }elseif ($status) {
                    $post = Post::where('status',$status)->get();
                }elseif ($user_id) {
                    $post = Post::where('user_id',$user_id)->get();
                }elseif ($date) {
                    $post = Post::where('date',$date)->get();
                }else{ 
                    $post = Post::get();
                }
                if ($post) {
                    return response([
                        'success' => true,
                        'message' => 'Data Post found',
                        'data' => $post
                    ], 200);
                }else {
                    return response([
                        'success' => true,
                        'message' => 'Data Post not found',
                        'data' => null
                    ], 404);
                }    
            } catch (Exception $error) {
                //throw $th;
                return response([
                    'success' => false,
                    'message' => 'Somethings Wrong',
                    'error' => $error,
    
                ], 500);
            }
    
    
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
                'title' => ['required'],
                'content' => ['required'],    
            ]);
            $post = Post::create([
                'user_id' => Auth::user()->id,
                'title' =>$request->input('title'),
                'content' =>$request->input('content'),
                'date' =>date('Y-m-d'),
            ]);

            return response([
                'success' => true,
                'message' => 'Post Has been saved',
                'data' => $post
            ], 200);
        }
    
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show(Post $post)
        {
            //
            if ($post) {
                
                return response([
                    'success' => true,
                    'message' => 'Data Post has found',
                    'data' => $post
                ], 200);
            }else {
                return response([
                    'success' => true,
                    'message' => 'Data not found',
                    'data' => null
                ], 404);
            }


        }
    
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request,Post $post)
        {
            //
            $validated = $request->validate([
                'title' => ['required'],
                'content' => ['required'],    
            ]);
            $post->update($validated);
            return response([
                'success' => true,
                'message' => 'Post Has been updated',
                'data' => $post
            ], 200);
        }
    
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(Post $post)
        {
            //
            $post->delete();
            return response([
                'success' => true,
                'message' => 'Post Has been deleted',
            ], 200);
        //
        }
        
    
}