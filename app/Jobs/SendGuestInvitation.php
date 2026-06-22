<?php

namespace App\Jobs;

use App\Models\Guest;
use App\Mail\GuestInvitation;
use App\Services\WhatsAppService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendGuestInvitation implements ShouldQueue
{
    use Queueable;

    public $guest;

    /**
     * Create a new job instance.
     */
    public function __construct(Guest $guest)
    {
        $this->guest = $guest;
    }

    /**
     * Execute the job.
     */
    public function handle(WhatsAppService $waService): void
    {
        Log::info("Processing SendGuestInvitation for {$this->guest->name}");

        // Send Email if available
        if (!empty($this->guest->email)) {
            try {
                Mail::to($this->guest->email)->send(new GuestInvitation($this->guest));
                Log::info("Email sent to {$this->guest->email}");
                $this->guest->email_status = 'sent';
                $this->guest->save();
            } catch (\Exception $e) {
                Log::error("Failed to send email to {$this->guest->email}: " . $e->getMessage());
                $this->guest->email_status = 'failed';
                $this->guest->save();
            }
        }

        // Send WhatsApp if available
        if (!empty($this->guest->phone)) {
            $waService->sendInvitation($this->guest);
        }
    }
}
