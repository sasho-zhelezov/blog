<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $post_id)
    {
        $request->validate([
            'text' => 'required|string|max:500|min:1',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $comment = Comment::create([
            'post_id' => $post_id,
            'user_id' => $request->user()->id,
            'parent_id' => $request->parent_id, // Null for top-level, or the ID of the parent comment
            'text' => $request->text,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Post $post, Comment $comment)
    {

        if ($request->user()->id !== $comment->user_id) {
            return redirect()->route('posts.index')->with('error', 'You can only edit your own comments.');
        }

        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post, Comment $comment)
    {
        $request->validate([
            'text' => 'required|string|max:1000',
        ]);


        $comment = Comment::findOrFail($comment->id);

        if ($request->user()->id !== $comment->user_id) {
            return redirect()->route('posts.index')->with('error', 'You can only edit your own comments.');
        }

        $comment->text = $request->input('text');
        $comment->save();

        return redirect()->route('post.show', $comment->post_id)->with('success', 'Comment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Post $post, Comment $comment)
    {

        if ($request->user()->id !== $comment->user_id) {
            return redirect()->route('posts.index')->with('error', 'You can only delete your own comments.');
        }

        $comment->delete();

        return redirect()->route('post.show', $comment->post_id)->with('success', 'Comment deleted successfully.');
    }
}
