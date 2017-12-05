<?php
/**
 * Squille PHP Framework (http://squille.com/squille-php-framework)
 *
 * @copyright Copyright (c) 2017 Squille
 * @license   this software is distributed under MIT license, see the license.mit file
 */

namespace Squille\Core;

class Route {
    private $ids;
    private $module;
    private $controller;
    private $action;

    public function __construct($route) {
        $this->ids = new Collection();
        $this->parse($route);
    }

    public function getIds() {
        return $this->ids;
    }

    public function getModule() {
        return $this->module;
    }

    public function setModule($value) {
        $this->module = $value;
    }

    public function getController() {
        return $this->controller;
    }

    public function getAction() {
        return $this->action;
    }

    private function parse($route) {
        $routes = $this->split($route);
        
        @$this->module = $routes[0];
        @$this->controller = $routes[1];
        $this->action = isset($routes[2]) ? $routes[2] : 'index';
        
        for ($i = 3; $i < count($routes); $i ++) {
            $this->ids->append($routes[$i]);
        }
    }

    private function split($route) {
        preg_match_all('~/([A-Za-z0-9-]+)~', $route, $matches);
        return $matches[1];
    }
}
