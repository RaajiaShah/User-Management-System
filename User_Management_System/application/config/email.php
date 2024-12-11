<?php

defined('BASEPATH') or exit('No direct script access allowed');

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.gmail.com';
$config['smtp_port'] = 587;
$config['smtp_user'] = 'raajiashah801@gmail.com'; // Replace with your email
$config['smtp_pass'] = 'mhmb giev hypb rbci'; // Replace with your app password
$config['mailtype'] = 'html';
$config['charset']  = 'utf-8';
$config['wordwrap'] = TRUE;
$config['smtp_timeout'] = 30;
$config['smtp_keepalive'] = TRUE;
$config['smtp_crypto'] = 'tls';
$config['stream'] = [
    'ssl' => [
        'verify_peer'       => false,
        'verify_peer_name'  => false,
        'allow_self_signed' => true
    ]
];



?>