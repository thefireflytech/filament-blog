<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Blog Post Notification</title>
    <style>
        /* Reset styles for email compatibility */
        body, p, h1, h2, h3, h4, h5, h6 {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .project-name {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }

        .content {
            margin-bottom: 20px;
        }

        .content h2 {
            margin-bottom: 10px;
        }

        .content p {
            margin-bottom: 15px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .footer {
            text-align: center;
        }
        .flash {
            text-align: center;
            color: #007bff;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="project-name">
        {{ config('app.name') }}
    </div>
    <h2 class="flash">New Blog Post Published!</h2>
    <div class="header">
        <img src="{{ $post->featurePhoto }}" alt="Feature Image">
    </div>
    <div class="content">
        <h2>{{ $post->title }}</h2>
        <p>{!! Str::limit($post->body, 500) !!} </p>
        <a href="{{route('filamentblog.post.show', ['post' => $post->slug])}}" class="btn">Read More</a>
    </div>
    <div class="footer">
        <p>Thank you for subscribing to our blog updates!</p>
    </div>
</div>
</body>
</html>
