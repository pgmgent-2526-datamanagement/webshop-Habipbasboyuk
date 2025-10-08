<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Article extends Component
{
    public $title;
    public $image;
    public $serienumber;
    public $price;
    public $excerpt;
    public $url;

    public function __construct($title = '', $image = null, $excerpt = '', $url = '#', $serienumber = null, $price = null)
    {
        $this->title = $title;
        $this->image = $image;
        $this->url = $url;
        $this->serienumber = $serienumber;
        $this->price = $price;
    }

    public function render()
    {
        return view('components.article');
    }
}