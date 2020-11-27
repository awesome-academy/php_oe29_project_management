<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProjectApproved extends Notification
{
    use Queueable;

    protected $projectName, $url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($projectName, $url)
    {
        $this->projectName = $projectName;
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'projectName' => $this->projectName,
            'url' => $this->url,
        ];
    }
}
