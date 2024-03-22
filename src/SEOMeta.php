<?php

namespace Firefly\FilamentBlog;

use Illuminate\Config\Repository as Config;
use Illuminate\Support\Collection;

class SEOMeta
{
    protected $title;

    protected $description;

    protected $keywords = [];

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

        return implode(PHP_EOL, $html);
    }

    public function setTitle($title)
    {
        // open redirect vulnerability fix
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
        // clean keywords
        $keywords = array_map('strip_tags', $keywords);
        // store keywords
        $this->keywords = $keywords;

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
