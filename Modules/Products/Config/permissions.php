<?php

return [
    'products.products' => [
        'index' => 'products::products.list resource',
        'create' => 'products::products.create resource',
        'edit' => 'products::products.edit resource',
        'destroy' => 'products::products.destroy resource',
    ],
    'products.categories' => [
        'index' => 'products::categories.list resource',
        'create' => 'products::categories.create resource',
        'edit' => 'products::categories.edit resource',
        'destroy' => 'products::categories.destroy resource',
    ],
// append


];
