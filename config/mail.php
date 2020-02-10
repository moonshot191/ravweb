<?php
return [
    "driver" => "smtp",
    "host" => "smtp.mailtrap.io",
    "port" => 2525,
    "from" => array(
        "address" => "from@example.com",
        "name" => "Example"
    ),
    "username" => "1e8a7b801d5b4b" ,// your username,
  "password" => "a23bfdc19a5296" ,// your password,
  "sendmail" => "/usr/sbin/sendmail -bs",
];
