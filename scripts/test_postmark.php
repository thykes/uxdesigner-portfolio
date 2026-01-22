<?php
// scripts/test_postmark.php

require __DIR__ . '/../vendor/autoload.php';

// "6c39a52b-4a50-4368-9d51-8a68389f69e7"
$token = '6c39a52b-4a50-4368-9d51-8a68389f69e7';

// Note: If your IDE warns about "Unknown class", it is a false positive.
// The class is loaded correctly via composer's autoloader at runtime.
$client = new \Postmark\PostmarkClient($token);

$sender = 'notifications@timhykes.com';
$to = 'tim@timhykes.com';
$subject = 'TDD Test: Postmark Integration Verified';
$htmlBody = '<strong>Hello Timothy,</strong><br>This is a verification email from your local test script using Postmark API.';
$textBody = 'Hello Timothy, This is a verification email from your local test script using Postmark API.';

try {
    echo "Sending email to $to from $sender...\n";
    $sendResult = $client->sendEmail(
        $sender,
        $to,
        $subject,
        $htmlBody,
        $textBody
    );

    echo "Success! Message ID: " . $sendResult->MessageID . "\n";
    exit(0);
} catch (Exception $e) {
    echo "Error sending email: " . $e->getMessage() . "\n";
    exit(1);
}
