<?php

namespace App\Services;

use App\Models\Guest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    /**
     * Send a WhatsApp message to a guest containing their unique link.
     */
    public function sendInvitation(Guest $guest)
    {
        if (empty($guest->phone)) {
            return false;
        }

        // Format phone number to international format (Fonnte requirement)
        $phone = preg_replace('/\D/', '', $guest->phone);
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        $frontendUrl = config('app.frontend_url', 'http://localhost:3000');
        $link = "$frontendUrl/invite/{$guest->slug}";

        $message = "Halo {$guest->name},\n\n";
        $message .= "Kami dengan senang hati mengundang Anda untuk hadir di acara Pernikahan kami.\n";
        $message .= "Silakan klik tautan di bawah ini untuk melihat detail undangan Anda:\n\n";
        $message .= $link . "\n\n";
        $message .= "Terima kasih,\nAndrianus & Ribka";

        $token = env('FONNTE_TOKEN');

        if (empty($token)) {
            Log::warning("WhatsApp Fonnte token is not set. Skipped sending WA to {$phone}");
            return false;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->post('https://api.fonnte.com/send', [
                'target' => $phone,
                'message' => $message,
            ]);

            if ($response->successful() && $response->json('status') === true) {
                Log::info("Fonnte: WhatsApp message sent successfully to {$phone}");
                $guest->wa_status = 'sent';
                $guest->save();
                return true;
            } else {
                Log::error("Fonnte Error: Failed to send WA to {$phone}. Response: " . $response->body());
                $guest->wa_status = 'failed';
                $guest->save();
                return false;
            }
        } catch (\Exception $e) {
            Log::error("Fonnte Exception: " . $e->getMessage());
            $guest->wa_status = 'failed';
            $guest->save();
            return false;
        }
    }
}
