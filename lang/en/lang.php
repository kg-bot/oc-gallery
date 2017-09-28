<?php return [
    'plugin' => [
        'name' => 'KG Gallery',
        'description' => '',
    ],
    'gallery' => [
        'title' => [
            'label' => 'Title',
            'comment' => 'Insert Gallery Title',
            'placeholder' => 'Gallery title',
        ],
        'slug' => [
            'label' => 'Slug',
            'comment' => 'Insert Gallery Slug',
            'placeholder' => 'Gallery Slug',
        ],
        'description' => [
            'label' => 'Description',
            'comment' => 'Insert Gallery Description',
            'placeholder' => 'Short description about your gallery',
        ],
        'published' => [
            'label' => 'Published',
            'comment' => 'Is This Gallery Published',
        ],
        'tabs' => [
            'details' => 'Description'
        ]
    ],
    'tags' => [
        'title' => [
            'label' => 'Title',
            'comment' => 'Insert Tag Title',
            'placeholder' => 'Tag Title',
        ],
    ],
    'images' => [
        'title' => [
            'label' => 'Title',
            'comment' => 'Insert Image Title',
            'placeholder' => 'Image Title',
        ],
        'tags' => [
            'label' => 'Image Tags',
            'comment' => 'Select Image Tags',
        ],
        'src' => [
            'label' => 'Select Image',
            'comment' => 'Select Image To Insert',
        ],
        'description' => [
            'label' => 'Image Description',
            'comment' => 'Insert Image Description',
            'placeholder' => 'Short description about image',
        ],
    ],
    'menues' => [
        'side' => [
            'galleries' => 'Galleries',
            'tags' => 'Tags',
            'images' => [
                'label' => 'Images',
            ],
        ],
        'main' => [
            'gallery' => 'KG Gallery',
        ],
    ],
    'permissions' => [
        'galleries' => [
            'title' => 'KG Gallery',
            'label' => 'Access And Modify Galleries',
        ],
        'tags' => [
            'label' => 'Access And Modify Tags',
        ],
        'images' => [
            'label' => 'Access And Modify Images',
        ],
    ],
    'toolbars' => [
        'reorder' => 'Reorder Items',
    ],
    'imageslabel' => 'Upload Images',
];