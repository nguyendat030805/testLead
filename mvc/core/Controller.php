<?php
class Controller {
    public function model($model) {
        require_once "./mvc/model/" . $model . ".php";
        return new $model;
    }

    public function view($view, $data = []) {
        require_once "./mvc/views/" . $view . ".php";
    }
    public function redirect($url) {
        header("Location: $url");
        exit();
    }
}

?>