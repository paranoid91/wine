<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\User;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PwdEmail extends Job
{
    /**
     * User Model.
     *
     */
    protected $user;

    /**
     * PwdEmail constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param Mailer $mailer
     */
    public function handle(Mailer $mailer)
    {
        $data = [
            'title'  => trans('front.recovery_mail_title'),
            'intro'  => trans('front.recovery_mail_intro'),
            'link'   => trans('front.recovery_mail_link'),
            'confirmation_code' => $this->user->confirmation_code
        ];

        $mailer->send('emails.auth.recovery', $data, function($message) {
            $message->from('recovery@megamediamarket.com')->to($this->user->email, $this->user->name)
                ->subject(trans('front.recovery_mail_title'));
        });
    }
}
