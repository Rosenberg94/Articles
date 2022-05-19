<?php

namespace App\Listeners;

use App\Events\CategoryDeleteEvent;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ThisArticlesDeleteListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
//    public function __construct()
//    {
//        //
//    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CategoryDeleteEvent  $event
     * @return void
     */
    public function handle(CategoryDeleteEvent $event)
    {
        $articles = Article::where('category_id', $event->category->id);
        if($articles){
            $category_id = $event->category->id;
            $comments = Comment::leftJoin('articles', 'articles.id', '=', 'comments.article_id')
                ->where('articles.category_id', '=', $category_id)
                ->select('comments.id as comment_id')
                ->get();

            Comment::whereIn('id', $comments)->delete();

            $articles->delete();
        }
    }
}
