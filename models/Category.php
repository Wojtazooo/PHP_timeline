<?php
class Category
{
    private $id;
    private $name;
    private $color;

    public function __construct($id, $name, $color)
    {
        $this->id = $id;
        $this->name = $name;
        $this->color = $color;
    }

    function getId()
    {
        return $this->id;
    }
}
