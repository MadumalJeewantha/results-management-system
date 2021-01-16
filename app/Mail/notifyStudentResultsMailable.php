<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class notifyStudentResultsMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    // Public gives access in Markdons 
    public $request;

    public function __construct($request)
    {
        $this->request = $request;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('notifyStudentResultsMarkdown')
        ->subject('New result released') 
        ->from('noreply@rms.com');
    }
}
