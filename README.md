# Firefly Filament Blog
The Filament Blog Plugin is a feature-rich plugin designed to enhance your blogging experience on your website. It comes with a variety of powerful features to help you manage and customize your blog posts effectively.

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
![Packagist License][ico-license]
![GitHub forks][ico-forks]
![GitHub Org's stars][ico-stars]



![Firefly Filament Blog](https://raw.githubusercontent.com/thefireflytech/filament-blog/master/images/landing.png)

## Features

- **Easy Installation:** Simple and straightforward installation process.
- **User-Friendly Interface:** Intuitive and user-friendly interface for easy management of blog posts.
- **SEO Meta Extension:** Enhance your blog's search engine optimization with built-in meta tag customization.
- **Post Scheduled for Future:** Schedule your blog posts to be published at a future date and time.
- **Social Media Share Feature:** Allow users to easily share your blog posts on social media platforms.
- **Comment Feature:** Enable comments on your blog posts to encourage engagement and discussion.
- **Newsletter Subscription:** Integrate newsletter subscription forms to grow your email list.
- **New Post Published Notification:** Notify subscribers when a new blog post is published.
- **Category Search:** Categorize your blog posts for easy navigation and search.
- **Support**: [Laravel 11](https://laravel.com) and [Filament 3.x](https://filamentphp.com)

## Demo Video
[![IMAGE ALT TEXT HERE](https://img.youtube.com/vi/8UkcAicQZUc/0.jpg)](https://www.youtube.com/watch?v=8UkcAicQZUc)

## Upgrade Note
>Important: If you are upgrading from version 1.x to 2.x, please follow the steps below:
> - Backup your database before running the migration. <i> This is just for safety purposes.</i>
> - Now you can add prefix on blog tables from the config file. 
```php  
'tables' => [
    'prefix' => 'fblog_', // prefix for all blog tables
    ],
```
> - After set the prefix please run the migration by running the following command: 
``php artisan filament-blog:upgrade-tables``
## Installation
If your project is not already using Filament, you can install it by running the following commands:
```bash
composer require filament/filament:"^3.2" -W
```
```bash
php artisan filament:install --panels
```
Install the Filament Blog Plugin by running the following command:
 ```bash
composer require firefly/filament-blog
```

## Usage
After composer require, you can start using the Filament Blog Plugin by runing the following command:

```bash
php artisan filament-blog:install
```
This command will publish `filamentblog.php` config file and `create_blog_tables.php` migration file.
````php
<?php

/**
 * |--------------------------------------------------------------------------
 * | Set up your blog configuration
 * |--------------------------------------------------------------------------
 * |
 * | The route configuration is for setting up the route prefix and middleware.
 * | The user configuration is for setting up the user model and columns.
 * | The seo configuration is for setting up the default meta tags for the blog.
 * | The recaptcha configuration is for setting up the recaptcha for the blog.
 */

use Firefly\FilamentBlog\Models\User;

return [
    'tables' => [
        'prefix' => 'fblog_', // prefix for all blog tables
    ],
    'route' => [
        'prefix' => 'blogs',
        'middleware' => ['web'],
        //        'home' => [
        //            'name' => 'filamentblog.home',
        //            'url' => env('APP_URL'),
        //        ],
        'login' => [
            'name' => 'filamentblog.post.login',
        ],
    ],
    'user' => [
        'model' => User::class,
        'foreign_key' => 'user_id',
        'columns' => [
            'name' => 'name',
            'avatar' => 'profile_photo_path', // column name for avatar
        ],
    ],
    'seo' => [
        'meta' => [
            'title' => 'Filament Blog',
            'description' => 'This is filament blog seo meta description',
            'keywords' => [],
        ],
    ],

    'recaptcha' => [
        'enabled' => false, // true or false
        'site_key' => env('RECAPTCHA_SITE_KEY'),
        'secret_key' => env('RECAPTCHA_SECRET_KEY'),
    ],
];
````
If you have a different url for the home page, you can set it in the `home` key in the `route` configuration.
Before running the migration, you can modify the `filamentblog.php` config file to suit your needs.

 If you want to publish config, views, components, and migrations individually you can run the following command:
```bash
php artisan vendor:publish --provider="Firefly\FilamentBlog\FilamentBlogServiceProvider" --tag=filament-blog-views
```
```bash
php artisan vendor:publish --provider="Firefly\FilamentBlog\FilamentBlogServiceProvider" --tag=filament-blog-config
```
```bash
php artisan vendor:publish --provider="Firefly\FilamentBlog\FilamentBlogServiceProvider" --tag=filament-blog-components
```
```bash
php artisan vendor:publish --provider="Firefly\FilamentBlog\FilamentBlogServiceProvider" --tag=filament-blog-migrations
```

## What if you have already a User model?
- If you already have a User model, you can modify the `filamentblog.php` config file to use your User model.
- Make sure the name column is the user's `name` column.
- If you have already `avatar` column in your User model, you can set it in the `filamentblog.php` config file in `user.columns.avatar` key.
- If you want to change `foreign_key` column name, you can modify the `filamentblog.php` config file.

## Migrate the database
After modifying the `filamentblog.php` config file, you can run the migration by running the following command:
```bash
php artisan migrate
```
## Storage Link
After running the migration, you can create a symbolic link to the storage directory by running the following command:
```bash
php artisan storage:link
```
## Attach filament blog panel to the dashboard
You can attach the Filament Blog panel to the dashboard by adding the following code to your panel provider:
Add `Blog::make()` to your panel passing the class to your `plugins()` method.

```php
use Firefly\FilamentBlog\Blog;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            Blog::make()
        ])
}
```

## Manage user relationship
If you want to manage the user relationship, you can modify the `User` model to have a relationship with the `Post` model.
```php
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Firefly\FilamentBlog\Traits\HasBlog;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasBlog;
}
```
## Allow user to comment
If you want to allow users to comment on blog posts, you can modify the `User` model to add a method `canComment()`.

```php
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Firefly\FilamentBlog\Traits\HasBlog;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
   public function canComment(): bool
    {
        // your conditional logic here
        return true;
    }
    
}
```
Now you can start using the Filament Blog Plugin to manage your blog posts effectively.
```yourdomain.com/blogs```
You can change the route prefix in the `filamentblog.php` config file.

## Social Media Share
For social media share, please visit [Sharethis](https://platform.sharethis.com) and generate the JS Script and HTML code and save from our share snippet section.

## Recaptcha
To add the recaptcha to the blog comment form, you can add environment variables in your `.env` file.
And make sure enabled is set to `true` in the `filamentblog.php` config file.
```
RECAPTCHA_SITE_KEY
RECAPTCHA_SECRET_KEY
```
## Credits

- [Firefly][link-author]
- [Asmit Nepali][link-asmit]
- [Awcodes](https://github.com/awcodes/filament-tiptap-editor)
- [All Contributors][link-contributors]

### Security

If you discover a security vulnerability within this package, please send an e-mail to dev@thefireflytech.com, All security vulnerabilities will be promptly addressed.

### 🤝 Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### 📄 License

The MIT License (MIT). Please see [License File](LICENSE.txt) for more information.


<i>Made with love by Firefly IT Solutions, Nepal - [thefireflytech.com](https://thefireflytech.com)</i>


[ico-version]: https://img.shields.io/packagist/v/firefly/filament-blog.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/firefly/filament-blog.svg?style=flat-square
[ico-stable]: https://img.shields.io/packagist/s/firefly/filament-blog.svg?style=flat-square
[ico-license]: https://img.shields.io/packagist/l/firefly/filament-blog.svg?style=flat-square
[ico-forks]: https://img.shields.io/github/forks/thefireflytech/filament-blog.svg?style=flat-square
[ico-stars]: https://img.shields.io/github/stars/thefireflytech?style=flat-square


[link-packagist]: https://packagist.org/packages/firefly/filament-blog
[link-downloads]: https://packagist.org/packages/firefly/filament-blog
[link-author]: https://github.com/thefireflytech
[link-asmit]: https://github.com/AsmitNepali
[link-contributors]: ../../contributors
