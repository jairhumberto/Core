<?php
/**
 * Squille Core (https://github.com/jairhumberto/Core)
 *
 * MIT License
 *
 * Copyright (c) 2017 Jair Humberto
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace Squille\Core;

class Route
{
    private $ids;
    private $module;
    private $controller;
    private $action;

    public function __construct($route)
    {
        $this->ids = new Collection();
        $this->parse($route);
    }

    public function getIds()
    {
        return $this->ids;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function setModule($value)
    {
        $this->module = $value;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    private function parse($route)
    {
        $routes = $this->split($route);

        @$this->module = $routes[0];
        @$this->controller = $routes[1];
        $this->action = isset($routes[2]) ? $routes[2] : 'index';

        for ($i = 3; $i < count($routes); $i ++) {
            $this->ids->append($routes[$i]);
        }
    }

    private function split($route)
    {
        preg_match_all('~/([A-Za-z0-9-]+)~', $route, $matches);
        return $matches[1];
    }
}
