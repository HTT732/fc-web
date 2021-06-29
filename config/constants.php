<?php
return [
    'client' => [
        'per_page' => 12,
        'related_product' => 8
    ],
    'back_end' => [
        'per_page' => 20
    ],
    'domain' => 'localhost',
    'upload' => [
        'banner' => [
            'root' => 'uploads/banner',
            'size' => [
                'original' => array('width' => 1280, 'height' => 650),
                'small' => array('width' => 640, 'height' => 325)
            ]
        ],
        'product' => [
            'root' => 'uploads/products',
            'size' => [
                'medium' => array('width' => 580, 'height' => 652),
                'large' => array('width' => 800, 'height' => 900),
                'small' => array('width' => 280, 'height' => 315)
            ]
        ],
        'avatar' => [
            'root' => 'uploads/avatar',
            'size' => [
                'medium' => array('width' => 300, 'height' => 300)
            ]
        ]
    ],
    'image' => [
        'avatar' => 'admin/images/avatar/default.jpg'
    ]
];