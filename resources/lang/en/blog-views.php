<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Pages (Based on Blade path)
    |--------------------------------------------------------------------------
    */

    'blogs' => [

        'all-post' => [
            'title' => 'Latest News / Blogs',
            'no_posts' => 'No posts found',
        ],

        'category-post' => [
            'category' => 'Category',
            'no_posts' => 'No posts found',
        ],

        'index' => [
            'title' => 'Show all blogs',
            'no_posts' => 'No posts found',
        ],

        'search' => [
            'title' => 'Search Results',
            'no_posts' => 'No posts found',
        ],

        'show' => [
            'home' => 'Home',
            'blog' => 'Blog',
            'comments_title' => 'COMMENTS',
            'author_default_description' => 'Author',
            'tags' => 'Tags',
            'comments' => 'Comments',
            'related_posts' => 'Related Posts',
            'no_related_posts' => 'No related posts found.',
            'show_all' => 'Show all blogs',
        ],

        'tag' => [
            'tag' => 'Tag',
            'no_posts' => 'No posts found',
        ],

        'seo' => [
            'blog' => 'Blog | ',
            'all_posts' => 'All posts | ',
            'search_result' => 'Search result for ',
        ],

    ],


    /*
    |--------------------------------------------------------------------------
    | Components
    |--------------------------------------------------------------------------
    */

    'components' => [

        'comment' => [
            'leave_reply' => 'Leave a reply',
            'comment' => 'Comment *',
            'comment_placeholder' => 'Write your message here',
            'post' => 'Post a comment',
            'login_required' => [
                'text' => 'Please :login to post a comment and check if you have the permission to post a comment.',
                'login' => 'login',
            ],
        ],

        'header' => [
            'blogs' => 'Blogs',
            'categories' => 'Categories',
            'search' => 'Search',
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Layouts
    |--------------------------------------------------------------------------
    */

    'layout' => [

        'footer' => [
            'quick_links' => 'Quick Links',
            'no_links' => 'No links found.',
            'newsletter_title' => 'Subscribe to our Newsletter',
            'newsletter_desc' => 'Subscribe to our mailing list to receive daily updates!',
            'email' => 'Email',
            'email_placeholder' => 'Enter your email',
            'copyright' => 'All rights reserved.',
            'home' => 'Home',
            'all_posts' => 'All Posts',
        ],

    ],


    /*
    |--------------------------------------------------------------------------
    | Emails (View text only)
    |--------------------------------------------------------------------------
    */

    'mail' => [

        'blog_published' => [
            'subject' => 'New Blog Post Published!',
            'thanks' => 'Thank you for subscribing to our blog updates!',
            'read_more' => 'Read More',
        ],

    ],


    /*
    |--------------------------------------------------------------------------
    | UI Messages (Flash / Toast / Alerts)
    |--------------------------------------------------------------------------
    */

    'messages' => [

        'comment_submitted' => 'Comment submitted for approval.',
        'already_subscribed' => 'You have already subscribed.',
        'subscribed_successfully' => 'You have successfully subscribed.',
        'search_result_for' => 'Search result for :query',

    ],
];
