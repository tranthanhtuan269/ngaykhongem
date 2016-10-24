<?php

    $data = array(
        'name' => "test",
    );
    
    Mail::send('emails.welcome', $data, function ($message) {

            $message->from('admin@chodatso.com', 'Test');

            $message->to('tran.thanh.tuan269@gmail.com')->subject('Learning Laravel test email');

        });
    ?>