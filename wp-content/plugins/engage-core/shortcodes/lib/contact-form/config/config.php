<?php

return [
    'subject' => [
        'prefix' => '[Contact Form]'
    ],
    'emails' => [
        'to'   => 'prafgon@gmail.com', // Email to receive emails via the form.
        'from' => 'support@veented.com'  // A valid email where the domain should be the same when the form is hosted.
    ],
    'messages' => [
        'error'   => 'There was an error sending, please try again later.',
        'success' => 'Your message has been sent successfully.',
        'validation' => [
            'emptyname'    => 'Name is required.',
            'emptyemail'   => 'Email is invalid.',
            'emptysubject' => 'Subject is required.',
            'emptymessage' => 'Message is required.'
        ]
    ],
    'fields' => [
        'name'     => 'Name',
        'email'    => 'Email',
        'phone'    => 'Phone',
        'subject'  => 'Subject',
        'message'  => 'Message',
        'btn-send' => 'Send'
    ]
];