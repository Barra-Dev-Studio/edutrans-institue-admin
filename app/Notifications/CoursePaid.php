<?php

namespace App\Notifications;

use App\Models\OwnedCourse;
use App\Models\User;
use App\Services\CourseService;
use App\Services\OwnedCourseService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CoursePaid extends Notification
{
    use Queueable;
    protected $ownedCourse;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($courseId, $memberId)
    {
        $this->ownedCourse = OwnedCourse::where('course_id', $courseId)
            ->where('member_id', $memberId)
            ->with('course.mentor')
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
        $url = route('member.play', $this->ownedCourse->id);
        return (new MailMessage)
                    ->subject('Pembelian kelas di Edutrans Institute berhasil!')
                    ->greeting('Hallo ' . $this->user->name)
                    ->line('Kamu telah berhasil membeli kursus dengan judul ' . $this->ownedCourse->course->title . ' oleh ' . $this->ownedCourse->course->mentor->name)
                    ->line('Berikut kamu bisa akses detail kursusnya di bawah ini, ya.')
                    ->action('Mulai kursus', $url)
                    ->line('Detail transaksi bisa dilihat di halaman transaksi yang ada di halaman member')
                    ->line('Jika ada pertanyaan, silakan hubungi detail di bawah. Terima kasih telah memilih dan membeli kursus di Edutrans Institute! ');
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
