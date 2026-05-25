<?php

return [

    'blogs' => [

        'all-post' => [
            'title' => 'آخرین مطالب',
            'no_posts' => 'هیچ مطلبی یافت نشد',
        ],

        'category-post' => [
            'category' => 'دسته‌بندی',
            'no_posts' => 'هیچ مطلبی یافت نشد',
        ],

        'index' => [
            'title' => 'همه مطالب',
            'no_posts' => 'هیچ مطلبی یافت نشد',
        ],

        'search' => [
            'title' => 'نتایج جستجو',
            'no_posts' => 'هیچ نتیجه‌ای یافت نشد',
        ],

        'show' => [
            'home' => 'خانه',
            'blog' => 'وبلاگ',
            'comments_title' => 'نظرات',
            'author_default_description' => 'نویسنده',
            'tags' => 'برچسب‌ها',
            'comments' => 'دیدگاه‌ها',
            'related_posts' => 'مطالب مرتبط',
            'no_related_posts' => 'مطلب مرتبطی وجود ندارد.',
            'show_all' => 'مشاهده همه مطالب',
        ],

        'tag' => [
            'tag' => 'برچسب',
            'no_posts' => 'هیچ مطلبی یافت نشد',
        ],

        'seo' => [
            'blog' => 'وبلاگ | ',
            'all_posts' => 'همه مطالب | ',
            'search_result' => 'نتایج جستجو برای ',
        ],

    ],


    'components' => [

        'comment' => [
            'leave_reply' => 'ارسال دیدگاه',
            'comment' => 'نظر *',
            'comment_placeholder' => 'نظر خود را بنویسید',
            'post' => 'ارسال نظر',
            'login_required' => [
                'text' => 'لطفاً برای ارسال نظر :login کنید و بررسی کنید که اجازه ارسال نظر را دارید.',
                'login' => 'وارد شوید',
            ],
        ],

        'header' => [
            'blogs' => 'وبلاگ‌ها',
            'categories' => 'دسته‌بندی‌ها',
            'search' => 'جستجو',
        ],

    ],


    'layout' => [

        'footer' => [
            'quick_links' => 'لینک‌های سریع',
            'no_links' => 'لینکی یافت نشد.',
            'newsletter_title' => 'عضویت در خبرنامه',
            'newsletter_desc' => 'برای دریافت جدیدترین مطالب عضو شوید.',
            'email' => 'ایمیل',
            'email_placeholder' => 'ایمیل خود را وارد کنید',
            'copyright' => 'تمام حقوق محفوظ است.',
            'home' => 'خانه',
            'all_posts' => 'همه مطالب',
        ],

    ],


    'mail' => [

        'blog_published' => [
            'subject' => 'مطلب جدید منتشر شد!',
            'thanks' => 'از عضویت شما در خبرنامه سپاسگزاریم.',
            'read_more' => 'ادامه مطلب',
        ],

    ],


    'messages' => [
        'comment_submitted' => 'دیدگاه شما برای تأیید ارسال شد.',
        'already_subscribed' => 'قبلاً عضو شده‌اید.',
        'subscribed_successfully' => 'عضویت شما با موفقیت انجام شد.',
        'search_result_for' => 'نتایج جستجو برای :query',
    ],

];
