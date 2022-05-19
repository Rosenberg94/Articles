<?php

namespace App\Listeners;

use App\Events\ArticleDeleteEvent;
use App\Models\Comment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CommentsDeleteListener
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
     * @param  \App\Events\ArticleDeleteEvent  $event
     * @return void
     */
    public function handle(ArticleDeleteEvent $event)
    {
        $comments = Comment::where('article_id', $event->article->id);
        if($comments){
            $comments->delete();
        }
    }
}
