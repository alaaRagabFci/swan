<?php
return [
    'notification_types'=>[
        'order_request'=>'1',
        'driver_accept_order'=>'2'
    ],

    'order_status'=>[
        'pending'=>'0',
        'accepted_and_way_resturant'=>'1',
        'driver_arrive_resturant'=>'2',
        'driver_recieve_order'=>'3',
        'driver_way_customer'=>'4',
        'driver_arrive_customer'=>'5'
    ],
    'order_drivers_status'=>[
    'new'=>'1',
    'confirm'=>'2',
    'cancel'=>'3',
    'ignored'=>'4'
    ]

];