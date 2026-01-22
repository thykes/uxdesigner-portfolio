<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Form Submission</title>
</head>
<body style="font-family: sans-serif; line-height: 1.6; color: #333;">
    <h2 style="color: #000;">New Message from Portfolio Site</h2>
    <p>You have received a new inquiry.</p>
    
    <div style="background: #f9f9f9; padding: 20px; border-radius: 5px; margin: 20px 0;">
        <p><strong>Name:</strong> <?= html($sender) ?></p>
        <p><strong>Email:</strong> <a href="mailto:<?= html($email) ?>"><?= html($email) ?></a></p>
        <p><strong>Project Type:</strong> <?= html($project_type) ?></p>
        
        <hr style="border: 0; border-top: 1px solid #ddd; margin: 20px 0;">
        
        <p><strong>Message:</strong></p>
        <div style="white-space: pre-wrap;"><?= html($text) ?></div>
    </div>
    
    <p style="font-size: 12px; color: #888;">Sent from your website form.</p>
</body>
</html>
