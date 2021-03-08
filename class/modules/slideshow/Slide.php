<?php

namespace modules\slideshow;

use basics\Database;

class Slide
{
    public $image;
    public $rg;
    public $description;
    public $slideshow;

    public $token;
    public $id;

    public function getImage(){return $this->image;}
    public function setImage($image, $init=false)
    {
        if(!$init) Database::modify("slide", "image", $image, $this->token);
        $this->image = $image;
    }

    public function getRg(){return $this->rg;}
    public function setRg($rg, $init=false)
    {
        if(!$init) Database::modify("slide", "rg", $rg, $this->token);
        $this->rg = $rg;
    }

    public function getDescription(){return $this->description;}
    public function setDescription($description, $init=false)
    {
        if(!$init) Database::modify("slide", "description", $description, $this->token);
        $this->description = $description;
    }

    public function getSlideshow(){return $this->slideshow;}
    public function setSlideshow($slideshow, $init=false)
    {
        if(!$init) Database::modify("slide", "slideshow", $slideshow, $this->token);
        $this->slideshow = $slideshow;
    }

    public function getToken(){return $this->token;}
    public function setToken($token, $init=false){if($init) $this->token = $token;}

    public function getId(){return $this->id;}
    public function setId($id, $init=false){if($init) $this->id = $id;}
}