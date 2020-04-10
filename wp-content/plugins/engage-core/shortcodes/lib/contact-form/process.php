<?php

require_once 'vendor/Helpers/Config.class.php';
require_once 'vendor/SimpleMail/SimpleMail.class.php';

$config = new Engage_Mail_Config;

$config_data = [
    'subject' => [
        'prefix' => '[Contact Form]'
    ],
    'emails' => [
        'to'   => 'support@veented.com',
        'from' => 'support@veented.com'
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

$config->load_config( $config_data );

$errors = array();
$data   = array();

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $name    = stripslashes(trim($_POST['name']));
    $email   = stripslashes(trim($_POST['email']));
    $subject = stripslashes(trim($_POST['subject']));
    $message = stripslashes(trim($_POST['message']));
    $pattern = '/[\r\n]|Content-Type:|Bcc:|Cc:/i';
    $destination_email = stripslashes(trim($_POST['destination_email']));
	$destination_email = str_replace( '__xyzx__', '@', $destination_email );
	
    if (preg_match($pattern, $name) || preg_match($pattern, $email) || preg_match($pattern, $subject) || preg_match($pattern, $destination_email)) {
        die("Header injection detected");
    }

    if (empty($name)) {
        $errors['name'] = $config->get('messages.validation.emptyname');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = $config->get('messages.validation.emptyemail');
    }

    if (empty($subject)) {
        $errors['subject'] = $config->get('messages.validation.emptysubject');
    }

    if (empty($message)) {
        $errors['message'] = $config->get('messages.validation.emptymessage');
    }

    if (!empty($errors)) {
        $data['success'] = false;
        $data['errors']  = $errors;
    } else {
        $mail = new Engage_SimpleMail();
		
        $mail->setTo( $destination_email );
        $mail->setFrom( $destination_email );
        $mail->setSender( $name );
        $mail->setSenderEmail( $email );
        $mail->setSubject($config->get('subject.prefix') . ' ' . $subject);

        $body = "
        <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
        <html>
            <head>
                <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
            </head>
            <body>
                <h1>{$subject}</h1>
                <p><strong>{$config->get('fields.name')}:</strong> {$name}</p>
                <p><strong>{$config->get('fields.email')}:</strong> {$email}</p>
                <p><strong>{$config->get('fields.message')}:</strong> {$message}</p>
                <p><strong>Destination:</strong> {$destination_email}</p>
            </body>
        </html>";

        $mail->setHtml($body);
        $mail->send();

        $data['success'] = true;
        $data['message'] = $config->get('messages.success');
    }

    echo json_encode($data);
}