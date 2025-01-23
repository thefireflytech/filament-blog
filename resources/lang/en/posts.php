<?php

return [
    'title' => 'Posts',
    'plural_title' => 'Posts',
    'forms' => [
        'fields' => [
            'category' => 'Category',
            'title' => 'Title',
            'slug' => 'Slug',
            'sub_title' => 'Sub Title',
            'tags' => 'Tags',
            'body' => 'Body',
            'cover_photo' => 'Cover Photo',
            'photo_alt_text' => 'Photo Alt Text',
            'status' => [
                'label' => 'Status',
                'options' => [
                    'pending' => 'Pending',
                    'scheduled' => 'Scheduled',
                    'published' => 'Published',
                ],
            ],
            'published_at' => 'Published At',
            'scheduled_for' => 'Scheduled For',
            'user' => 'User',
            'keywords' => 'Keywords',
            'description' => 'Description',
        ],
        'sections' => [
            'general' => 'General',
            'publish_information' => 'Publish Information',
            'description' => 'Description',
            'header_title' => 'Blog Details',
            'titles' => 'Titles',
            'feature_image' => 'Feature Image',
            'status' => 'Status',
            'comment' => 'Comment',
        ],
        'tabs' => [
            'edit_page' => [
                'view_post' => 'View Post',
                'manage_seo_details' => 'Manage SEO Detail',
                'manage_comments' => 'Manage Comments',
                'edit_post' => 'Edit Post',
            ],
            'list_page' => [
                'all' => 'All',
                'published' => 'Published',
                'scheduled' => 'Scheduled',
                'pending' => 'Pending',
            ]
        ],
        'widget' => [
            'cards' => [
                'published_post' => 'Published Post',
                'scheduled_post' => 'Scheduled Post',
                'pending_post' => 'Pending Post',
            ]
        ],
        'actions' => [
            'preview' => 'Preview',
            'send_notification' => 'Send Notification',
        ]
    ],
    'tables' => [
        'columns' => [
            'title' => 'Title',
            'status' => 'Status',
            'cover_photo' => 'Cover Photo',
            'author' => 'Author',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'commented_by' => 'Commented By',
            'comment' => 'Comment',
            'approved_at' => [
                'label' => 'Approved At',
                'placeholder' => 'Not approved yet',
            ],
        ],
        'filters' => [
            'user' => 'User',
        ]
    ]
];