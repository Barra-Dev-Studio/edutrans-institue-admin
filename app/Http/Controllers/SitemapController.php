<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function generate()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.1))
            ->add(Url::create('/courses')
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.1))
            ->add(Url::create('/blog')
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.1))
            ->add(Url::create('/about')
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.1));

        Post::where('status', 'PUBLISH')->each(function ($post) use ($sitemap) {
           $sitemap->add(Url::create('post/' . $post->slug)
               ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
               ->setPriority(0.1)
           );
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));

    }
}
