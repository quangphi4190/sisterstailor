<?php

return [
    'orders.orders' => [
        'index' => 'orders::orders.list resource',
        'create' => 'orders::orders.create resource',
        'edit' => 'orders::orders.edit resource',
        'destroy' => 'orders::orders.destroy resource',
    ],
    'orders.order_details' => [
        'index' => 'orders::order_details.list resource',
        'create' => 'orders::order_details.create resource',
        'edit' => 'orders::order_details.edit resource',
        'destroy' => 'orders::order_details.destroy resource',
    ],
// append


];
