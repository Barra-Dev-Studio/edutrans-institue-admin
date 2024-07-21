<?php

namespace App\Notifications;

use App\Models\OwnedBook;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookPaid extends Notification
{
    use Queueable;
    protected $ownedBook;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($bookId, $memberId)
    {
        $this->ownedBook = OwnedBook::where('book_id', $bookId)
            ->where('member_id', $memberId)
            ->first();
        $this->user = User::find($memberId);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = route('member.book.index');
        return (new MailMessage)
                    ->subject('Pembelian ebook di Edutrans Institute berhasil!')
                    ->greeting('Hallo ' . $this->user->name)
                    ->line('Kamu telah berhasil membeli ebook dengan judul ' . $this->ownedBook->title . ' oleh ' . $this->ownedBook->author)
                    ->line('Berikut kamu bisa akses ebook di bawah ini, ya.')
                    ->action('Unduh ebook', $url)
                    ->line('Untuk mengakses ebook, simpan kunci berikut: ' . $this->ownedBook->key)
                    ->line('Detail transaksi bisa dilihat di halaman transaksi yang ada di halaman member')
                    ->line('Jika ada pertanyaan, silakan hubungi detail di bawah. Terima kasih telah memilih dan membeli ebook di Edutrans Institute! ');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
