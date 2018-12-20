<?php

namespace App\Observers;

use App\Jobs\TranslateSlug;
use App\Models\Topic;
use App\Notifications\TopicCreated;
use Parsedown;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }

    public function saving(Topic $topic)
    {
        $parse = new Parsedown();
        $topic->body = $parse->setBreaksEnabled(true)->text($topic->body);
        //xss
        $topic->body = clean($topic->body, 'user_topic_body');
        //excerpt
        $topic->excerpt = make_excerpt($topic->body);
    }

    public function created(Topic $topic)
    {
        foreach ($topic->user->followers as $follower) {
            $follower->notify(new TopicCreated($topic));
        }
    }

    public function saved(Topic $topic)
    {
        if (!$topic->slug) {
            dispatch(new TranslateSlug($topic));
        }

        activity('TopicCreated')
            ->performedOn($topic)
            ->causedBy($topic->user)
            ->log('TopicCreated');
    }

    public function deleted(Topic $topic)
    {
        \DB::table('replies')->where('topic_id', $topic->id)->delete();
    }
}
