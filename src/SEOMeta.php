<?php

namespace Firefly\FilamentBlog;

use Illuminate\Config\Repository as Config;
use Illuminate\Support\Collection;

class SEOMeta
{
    protected $title;

    protected $description;

    protected $keywords = [];
    
    protected $ogTitle;
    protected $ogDescription;
    protected $ogImage;

    protected $twitterTitle;
    protected $twitterDescription;
    protected $twitterImage;

    public function __construct(private Config $config)
    {
    }

    public function generate()
    {
        $html = [];
        $title = $this->getTitle();
        $description = $this->getDescription();
        $keywords = $this->keywords;
        
        if ($title) {
            $html[] = "<title>{$title}</title>";
        }
        if ($description) {
            $html[] = "<meta name='description' content='{$description}'>";
        }
        if (! empty($keywords)) {
            if ($keywords instanceof Collection) {
                $keywords = $keywords->toArray();
            }

            $keywords = implode(', ', $keywords);
            $html[] = "<meta name=\"keywords\" content=\"{$keywords}\">";
        }
        
        $ogTitle = $this->getOgTitle() ?: $title;
        $ogDescription = $this->getOgDescription() ?: $description;
        $ogImage = $this->getOgImage();
        
        if ($ogTitle) {
            $html[] = "<meta property='og:title' content='{$ogTitle}'>";
        }
        if ($ogDescription) {
            $html[] = "<meta property='og:description' content='{$ogDescription}'>";
        }
        if ($ogImage) {
            $html[] = "<meta property='og:image' content='{$ogImage}'>";
        }

        $twitterTitle = $this->getTwitterTitle() ?: $title;
        $twitterDescription = $this->getTwitterDescription() ?: $description;
        $twitterImage = $this->getTwitterImage() ?: $ogImage;
        
        if ($twitterTitle) {
            $html[] = "<meta name='twitter:title' content='{$twitterTitle}'>";
        }
        if ($twitterDescription) {
            $html[] = "<meta name='twitter:description' content='{$twitterDescription}'>";
        }
        if ($twitterImage) {
            $html[] = "<meta name='twitter:image' content='{$twitterImage}'>";
            $html[] = "<meta name='twitter:card' content='summary_large_image'>";
        }

        return implode(PHP_EOL, $html);
    }

    public function setTitle($title)
    {
        $title = str_replace(['http-equiv=', 'url='], '', $title);
        $title = strip_tags($title);
        $this->title = $title;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = ! $description ? $description : htmlspecialchars($description, ENT_QUOTES, 'UTF-8', false);
        return $this;
    }

    public function setKeywords(array $keywords)
    {
        $keywords = array_map('strip_tags', $keywords);
        $this->keywords = $keywords;
        return $this;
    }
    
    public function setOgTitle($title)
    {
        $title = str_replace(['http-equiv=', 'url='], '', $title);
        $this->ogTitle = strip_tags($title);
        return $this;
    }
    
    public function setOgDescription($description)
    {
        $this->ogDescription = ! $description ? $description : htmlspecialchars($description, ENT_QUOTES, 'UTF-8', false);
        return $this;
    }
    
    public function setOgImage($image)
    {
        $this->ogImage = strip_tags($image);
        return $this;
    }

    public function setTwitterTitle($title)
    {
        $title = str_replace(['http-equiv=', 'url='], '', $title);
        $this->twitterTitle = strip_tags($title);
        return $this;
    }
    
    public function setTwitterDescription($description)
    {
        $this->twitterDescription = ! $description ? $description : htmlspecialchars($description, ENT_QUOTES, 'UTF-8', false);
        return $this;
    }
    
    public function setTwitterImage($image)
    {
        $this->twitterImage = strip_tags($image);
        return $this;
    }

    public function getTitle()
    {
        return $this->title ?? $this->getDefaultTitle();
    }

    private function getDescription()
    {
        return $this->description ?? $this->getDefaultDescription();
    }

    public function getKeywords()
    {
        return $this->keywords ?? $this->getDefaultKeywords();
    }
    
    public function getOgTitle()
    {
        return $this->ogTitle;
    }
    
    public function getOgDescription()
    {
        return $this->ogDescription;
    }
    
    public function getOgImage()
    {
        return $this->ogImage;
    }

    public function getTwitterTitle()
    {
        return $this->twitterTitle;
    }
    
    public function getTwitterDescription()
    {
        return $this->twitterDescription;
    }
    
    public function getTwitterImage()
    {
        return $this->twitterImage;
    }

    public function getDefaultTitle()
    {
        return $this->config->get('filamentblog.seo.meta.title');
    }

    private function getDefaultDescription()
    {
        return $this->config->get('filamentblog.seo.meta.description');
    }

    public function getDefaultKeywords()
    {
        return $this->config->get('filamentblog.seo.meta.keywords');
    }
}
