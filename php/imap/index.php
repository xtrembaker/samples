<?php

$mailbox = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = '';
$password = '';

$stream = imap_open($mailbox, $username, $password);

var_dump($stream);
