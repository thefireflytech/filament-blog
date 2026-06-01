<?php

use Firefly\FilamentBlog\SEOMeta;
use Illuminate\Config\Repository;

it('generates basic meta tags', function () {
    $config = new Repository([
        'filamentblog' => [
            'seo' => [
                'meta' => [
                    'title' => 'Default Title',
                    'description' => 'Default Description',
                    'keywords' => ['default', 'keywords'],
                ],
            ],
        ],
    ]);

    $seoMeta = new SEOMeta($config);
    $html = $seoMeta->generate();

    expect($html)->toContain('<title>Default Title</title>')
        ->toContain("<meta name='description' content='Default Description'>")
        ->toContain('<meta property=\'og:title\' content=\'Default Title\'>')
        ->toContain("<meta name='twitter:title' content='Default Title'>");
});

it('generates custom open graph and twitter tags', function () {
    $config = new Repository([
        'filamentblog' => ['seo' => ['meta' => []]],
    ]);

    $seoMeta = new SEOMeta($config);
    
    $seoMeta->setTitle('Main Title');
    $seoMeta->setOgTitle('OG Title');
    $seoMeta->setOgDescription('OG Description');
    $seoMeta->setOgImage('og-image.jpg');
    
    $seoMeta->setTwitterTitle('Twitter Title');
    $seoMeta->setTwitterDescription('Twitter Description');
    $seoMeta->setTwitterImage('twitter-image.jpg');

    $html = $seoMeta->generate();

    expect($html)->toContain('<title>Main Title</title>')
        ->toContain("<meta property='og:title' content='OG Title'>")
        ->toContain("<meta property='og:description' content='OG Description'>")
        ->toContain("<meta property='og:image' content='og-image.jpg'>")
        ->toContain("<meta name='twitter:title' content='Twitter Title'>")
        ->toContain("<meta name='twitter:description' content='Twitter Description'>")
        ->toContain("<meta name='twitter:image' content='twitter-image.jpg'>")
        ->toContain("<meta name='twitter:card' content='summary_large_image'>");
});

it('falls back to default tags when custom specific tags are missing', function () {
    $config = new Repository([
        'filamentblog' => ['seo' => ['meta' => []]],
    ]);

    $seoMeta = new SEOMeta($config);
    $seoMeta->setTitle('Main Title');
    $seoMeta->setDescription('Main Description');

    $html = $seoMeta->generate();

    expect($html)->toContain("<meta property='og:title' content='Main Title'>")
        ->toContain("<meta property='og:description' content='Main Description'>")
        ->toContain("<meta name='twitter:title' content='Main Title'>")
        ->toContain("<meta name='twitter:description' content='Main Description'>");
});
