<?php

namespace App\Notifications;

use App\Models\Topic;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TopicCreated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $topic;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toDatabase($notifiable)
    {
        $link = $this->topic->link(['#Post'.$this->topic->id]);

        return [
            'topic_id'    => $this->topic->id,
            'topic_body'  => $this->topic->body,
            'user_id'     => $this->topic->user->id,
            'user_name'   => $this->topic->user->name,
            'user_avatar' => $this->topic->user->getAvatar(),
            'topic_link'  => $link,
            'topic_title' => $this->topic->title,
        ];
    }
}
