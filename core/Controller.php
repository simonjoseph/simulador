<?php
class Controller {
    protected function view($viewName, $data = []) {
        extract($data);
        require "app/Views/$viewName.php";
    }
}
?>
