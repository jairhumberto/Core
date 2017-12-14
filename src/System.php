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

class System
{
    private $config;
    private $args;

    public function __construct($config, Collection $args)
    {
        $this->config = $config;
        $this->args = $args;
    }

    public function init()
    {
        $route = $this->parseRoute($this->args->get('path'));

        $routeModule = include dirname($_SERVER['DOCUMENT_ROOT'])
                             . DIRECTORY_SEPARATOR . 'source'
                             . DIRECTORY_SEPARATOR . $route->getModule()
                             . DIRECTORY_SEPARATOR . 'routes.php';

        $module = new Module($route, $this->args, $routeModule);
        $module->init();
    }

    private function parseRoute($path)
    {
        $modules = new Collection($this->config['modules']);
        $route = new Route($path);

        $module = $modules->keyExists('/' . $route->getModule());

        if ($module === false) {
            $route = new Route('/' . $modules->getFirst() . $path);
        } else {
            $route->setModule($module);
        }

        return $route;
    }
}
