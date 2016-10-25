<?php

namespace App\Jobs;

use App\Http\Requests\ContactFormRequest;
use Illuminate\Mail\Mailer;

class ContactMail extends Job
{
    /**
     * User Model.
     *
     */
    protected $name,$email,$subject,$message;

    /**
     * PwdEmail constructor.
     * @param $request
     */
    public function __construct($request)
    {
        $this->subject = $request->input('subject');
        $this->name = $request->input('name');
        $this->email = $request->input('email');
        $this->message = $request->input('message');
    }

    /**
     * @param Mailer $mailer
     */
    public function handle(Mailer $mailer)
    {
        $data = [
            'title'  => $this->subject.' from '.$this->name,
            'text'  => $this->message,
        ];

        $mailer->send('emails.contact', $data, function($message) {
            $message->from($this->email)->to('vatia0@gmail.com', $this->name)
                ->subject($this->subject);
        });
    }
}
