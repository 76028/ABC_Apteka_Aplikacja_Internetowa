<?php
    $h='123';
    $h= password_hash($h, PASSWORD_DEFAULT);
    echo $h;
?>