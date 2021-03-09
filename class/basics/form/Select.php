<?php


namespace basics\form;


use JetBrains\PhpStorm\Pure;

class Select extends Input
{
    private array $options = array();
    private $selected = null;

    #[Pure] public function __construct($name, $displayName)
    {
        parent::__construct("select", $name, $displayName);
        return $this;
    }


    public function getOptions(): array {return $this->options;}
    public function addOption($name, $value) : Select
    {
        $this->options[$value] = $name;
        return $this;
    }

    public function getSelected(){return $this->selected;}
    public function setSelected($selected)
    {
        $this->selected = $selected;
    }
}