<?php
namespace App\Jobs;
use App\Jobs\Job;
use App\User;
use Request;
use Illuminate\Contracts\Mail\Mailer;
class SendMail extends Job
{
    /**
     * User Model.
     *
     */
    protected $user;

    /**
     * Create a new SendMailCommand instance.
     * SendMail constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Execute the job.
     *
     * @param  Mailer  $mailer
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $data = [
            'title'  => trans('front.register-email-title'),
            'intro'  => trans('front.register-email-intro'),
            'link'   => trans('front.register-email-link'),
            'confirmation_code' => $this->user->confirmation_code
        ];

        $mailer->send('emails.auth.verify', $data, function($message) {
            $message->from('noreply@megamediamarket.com')->to($this->user->email, $this->user->name)
                ->subject(trans('front.register-email-title'));
        });
    }
}