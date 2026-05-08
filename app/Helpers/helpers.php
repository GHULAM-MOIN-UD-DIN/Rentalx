<?php

if (!function_exists('img_url')) {
    /**
     * Generate the correct URL for an image.
     * If the image is already a full URL (Cloudinary), return it directly.
     * Otherwise, treat it as a local file in the given folder.
     */
    function img_url(?string $image, string $folder = ''): string
    {
        if (empty($image)) {
            return asset('images/placeholder.png');
        }

        // Already a full URL (Cloudinary or external)
        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
            return $image;
        }

        // Local file
        if ($folder) {
            return asset($folder . '/' . $image);
        }

        return asset($image);
    }
}

if (!function_exists('send_brevo_email')) {
    /**
     * Send email via Brevo HTTP API (bypasses SMTP port blocking on Render).
     * 
     * @param string $toEmail Recipient email
     * @param string $toName Recipient name
     * @param string $subject Email subject
     * @param string $htmlContent HTML body of the email
     * @return bool Whether the email was sent successfully
     * @throws \Exception If the API call fails
     */
    function send_brevo_email(string $toEmail, string $toName, string $subject, string $htmlContent): bool
    {
        $apiKey = env('BREVO_API_KEY', config('services.brevo.api_key'));
        
        if (empty($apiKey)) {
            throw new \Exception('BREVO_API_KEY is not set. Get it from Brevo Dashboard > Settings > API Keys.');
        }

        $fromEmail = env('MAIL_FROM_ADDRESS', 'moin69603@gmail.com');
        $fromName = env('MAIL_FROM_NAME', 'RENTALX');

        $data = [
            'sender' => ['name' => $fromName, 'email' => $fromEmail],
            'to' => [['email' => $toEmail, 'name' => $toName]],
            'subject' => $subject,
            'htmlContent' => $htmlContent,
        ];

        $ch = curl_init('https://api.brevo.com/v3/smtp/email');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'accept: application/json',
                'api-key: ' . $apiKey,
                'content-type: application/json',
            ],
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_TIMEOUT => 15,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            throw new \Exception('Brevo API curl error: ' . $error);
        }

        if ($httpCode >= 400) {
            $body = json_decode($response, true);
            $msg = $body['message'] ?? $response;
            throw new \Exception('Brevo API error (' . $httpCode . '): ' . $msg);
        }

        return true;
    }
}
