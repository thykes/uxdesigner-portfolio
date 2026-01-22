<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f4f4f7; color: #333333; margin: 0; padding: 0; }
        .main { background-color: #ffffff; margin: 20px auto; width: 100%; max-width: 600px; border-radius: 8px; overflow: hidden; border: 1px solid #eeeeee; }
        .header { background-color: #000000; padding: 30px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 18px; letter-spacing: 2px; text-transform: uppercase; }
        .content { padding: 40px; }
        .label { font-size: 11px; font-weight: bold; color: #999999; text-transform: uppercase; margin-bottom: 5px; }
        .value { font-size: 16px; margin-bottom: 25px; color: #111111; }
        .message-box { background-color: #f9f9f9; padding: 20px; border-left: 4px solid #000000; border-radius: 4px; font-style: italic; line-height: 1.6; }
        .footer { text-align: center; padding: 20px; font-size: 11px; color: #aaaaaa; }
        .button { display: inline-block; background-color: #000000; color: #ffffff !important; padding: 14px 24px; text-decoration: none; border-radius: 4px; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="main">
        <div class="header">
            <h1>TIM HYKES</h1>
        </div>
        <div class="content">
            <div class="label">From</div>
            <div class="value"><?= $name ?> (<?= $senderEmail ?>)</div>

            <div class="label">Project Type</div>
            <div class="value"><?= $projectType ?></div>

            <div class="label">Message</div>
            <div class="message-box">
                <?= $text ?>
            </div>

            <a href="mailto:<?= $senderEmail ?>" class="button">Reply to Inquiry</a>
        </div>
    </div>
    <div class="footer">
        Sent from your portfolio site via Kirby CMS.
    </div>
</body>
</html>
