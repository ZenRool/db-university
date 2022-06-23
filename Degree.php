<?php
class Degree {
    public $id;
    public $name;
    public $level;
    function __construct($_id, $_name, $_level) {
        $this->id = $_id;
        $this->name = $_name;
        $this->level = $_level;
    }
}
?>