<?php

namespace App\Services;

use Exception;

class View
{
    public $view;
    public $data = [];

    public function __construct($view)
    {
        $this->view = $view;
    }

    public static function make($viewName = null)
    {
        if (!$viewName) {
            throw new \Exception("Empty view name");
        } else {
            $viewFilePath = self::getFilePath($viewName);
            if (is_file($viewFilePath)) {
                return new View($viewFilePath);
            } else {
                throw new \Exception("View file not found");
            }
        }
    }

    public function with($key, $value = null)
    {
        $this->data[$key] = $value;
        return $this;
    }

    private static function getFilePath($viewName)
    {
        $filePath = str_replace('.', '/', $viewName);
        return path('app/Views') . $filePath . '.php';
    }

    public function __call($method, $parameters)
    {
        if (starts_with($method, 'with'))
        {
            return $this->with(snake_case(substr($method, 4)), $parameters[0]);
        }

        throw new \Exception("Method [$method] not found！.");
    }

    public function render()
    {
        extract($this->data);
        require_once($this->view);
    }
}