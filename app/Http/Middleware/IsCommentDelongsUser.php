<?php

namespace App\Http\Middleware;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class IsCommentDelongsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$this->authUserCheck($request->id)){
            return redirect(route('main'))->withErrors('You have no access to this action!');
        }

        return $next($request);
    }

    private function authUserCheck($comment_id):bool
    {
        $user = auth()->user();
        $comment = Comment::find($comment_id);

        return $user->id == $comment->user_id || $user->role_id == User::ROLE_ADMIN;
    }
}
