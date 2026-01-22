<?php
return function($kirby, $pages, $page) {

    $alert = null;

    if($kirby->request()->is('POST') && get('submit')) {

        // check the honeypot
        if(empty(get('website')) === false) {
            go($page->url());
            exit;
        }

        $data = [
            'name'         => get('name'),
            'email'        => get('email'),
            'project_type' => get('project_type'),
            'text'         => get('text')
        ];

        $rules = [
            'name'  => ['required', 'minLength' => 3],
            'email' => ['required', 'email'],
            'text'  => ['required', 'minLength' => 3, 'maxLength' => 3000],
        ];

        $messages = [
            'name'  => 'Please enter a valid name',
            'email' => 'Please enter a valid email address',
            'text'  => 'Please enter a text between 3 and 3000 characters'
        ];

        // some of the data is invalid
        if($invalid = invalid($data, $rules, $messages)) {
            $alert = $invalid;

            // the data is fine, let's send the email
        } else {
            try {
                // Initialize Postmark Client
                $client = new \Postmark\PostmarkClient(option('postmark.token'));
                
                // Prepare Data
                $emailData = [
                    'name'         => esc($data['name']),
                    'senderEmail'  => esc($data['email']),
                    'projectType'  => esc($data['project_type'] ?? ''),
                    'text'         => esc($data['text'])
                ];

                // Render Templates
                // Note: tpl::load returns the rendered content
                $htmlBody = \Kirby\Toolkit\Tpl::load($kirby->root('templates') . '/emails/inquiry.html.php', $emailData);
                $textBody = \Kirby\Toolkit\Tpl::load($kirby->root('templates') . '/emails/inquiry.php', $emailData);

                // Send Email via Postmark
                $client->sendEmail(
                    'notifications@timhykes.com',
                    'tim@timhykes.com',
                    'New Project Inquiry: ' . esc($data['name']),
                    $htmlBody,
                    $textBody,
                    null, // Tag
                    true, // TrackOpens
                    $data['email'] // Reply To
                );

            } catch (Exception $error) {
                if(option('debug')):
                    $alert['error'] = 'The form could not be sent: <strong>' . $error->getMessage() . '</strong>';
                else:
                    $alert['error'] = 'The form could not be sent!';
                endif;
            }

            // no exception occurred, let's send a success message
            if (empty($alert) === true) {
                $success = $page->success_message()->or('Your message has been sent, thank you. We will get back to you soon!');
                $data = [];
            }
        }
    }

    return [
        'alert'   => $alert,
        'data'    => $data ?? false,
        'success' => $success ?? false
    ];
};