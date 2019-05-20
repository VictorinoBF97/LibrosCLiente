<?php

namespace App\Notifications;

use App\Book;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BookCreated extends Notification
{
    use Queueable;

    public $book;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Notification: New Book Created - ' . $this->book->title)
            ->greeting('Great News!')
            ->line('A new book has been created.')
            ->action('Book Info', url('/books/'. $this->book->slug))
            ->line('Thank you for using our application!')
            ->salutation('Powered by Laravel');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'book' => $this->book
        ];
    }
}
