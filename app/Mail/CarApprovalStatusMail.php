<?php

namespace App\Mail;

use App\Models\Car;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CarApprovalStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $car;
    public $statusText;

    public function __construct(Car $car, $statusText)
    {
        $this->car = $car;
        $this->statusText = $statusText;
    }

    public function build()
    {
        return $this->subject('Your Car Approval Status Changed')->markdown('admin.emails.car_status_change')->with([
            'car' => $this->car,
            'statusText' => $this->statusText,
        ]);
    }
}
