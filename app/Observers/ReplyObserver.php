<?php

namespace App\Observers;

use App\Models\Reply;
use App\Models\User;
use App\Notifications\AtSomeone;
use App\Notifications\TopicReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content, 'user_topic_body');
    }

    public function created(Reply $reply)
    {
        $topic = $reply->topic;

        $topic->increment('reply_count', 1);
        $topic->user->notify(new TopicReplied($reply));
        if (preg_match_all('/@[\w-]+\s?/', $reply->content, $matches)) {
            foreach ($matches[0] as $value) {
                $name = ltrim($value, '@');
                $user = User::where('name', $name)->first();
                if ($user) {
                    $user->notify(new AtSomeone($reply));
                }
            }
        }
    }

    public function deleted(Reply $reply)
    {
        $reply->topic->decrement('reply_count', 1);
    }
}
