<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    public function createForm(Request $request)
    {
        $article = Article::find($request->id);

        return view('forms.comment.create', ['article' => $article]);
    }


    public function create(Request $request)
    {
        $data = $request->except("_token");
        $request->validate([
            'content' => ['bail', 'required', 'string', 'min:10', 'max:2555'],
        ]);
        $file = $request->file('image');
        if($file){
            $data['image'] = $request->file('image')->store(
                'images', 'public');
        }
        $data['user_id'] = auth()->user()->id;
        $comment = Comment::create($data);

        return redirect(route('article_show', ['id' => $comment->article->id]))->with('success', 'Comment has been successfully edited!');
    }


    public function edit(Request $request)
    {
        $comment = Comment::find($request->id);

        return view('forms.comment.edit', ['comment' => $comment]);
    }


    public function update(Request $request)
    {
        $input = $request->except('_token');
        if ($comment = Comment::find($request->id)){
            $file = $request->file('image');
            if ($file) {
                $this->__commentImageDestroy($request);
                $input['image'] = $request->file('image')->store(
                    'images', 'public');
            }
            $comment->update($input);
            $id = $comment->article->id;

            return redirect(route('article_show', ['id' => $id]))->with('success', 'Comment has been successfully edited!');
        }

        return back()->withErrors( 'The comment is not isset');
    }


    public function destroy(Request $request)
    {
        $comment = Comment::find($request->id);
        if ($comment){
            if($this->authUserCheck($comment)){
                $comment->delete();

                return redirect(route('main'))->with('success', 'Comment has been successfully deleted!');
            }
            return back()->withErrors( 'You have no access for this action!');
        }
        return back()->withErrors( 'This comment is not exist already!');
    }


    private function authUserCheck($comment)
    {
        $user = auth()->user();

        return $user->id == $comment->user_id || $user->role_id == User::ROLE_ADMIN;
    }


    private function __commentImageDestroy($request)
    {
        $comment = Article::find($request->comment);
        if (isset($comment->image)){
            if(Storage::disk('public')->exists($comment->image)){
                Storage::delete($comment->image);
            }
        }
    }

}




