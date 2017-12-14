<?php
/**
 * Squille Core (https://github.com/jairhumberto/Core)
 *
 * MIT License
 *
 * Copyright (c) 2018 Jair Humberto
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

class Module
{
    private $route;
    private $args;
    private $routeMap;

    public function __construct(Route $route, Collection $args, $routeMap)
    {
        $this->route = $route;
        $this->args = $args;
        $this->routeMap = $routeMap;
    }

    public function init()
    {
        foreach ($this->routeMap as $route => $class) {
            if (preg_match('~' . $route . '(/.*)*$~', $this->args->get('path'))) {
                $this->initController($class);
                return;
            }
        }

        throw new ModuleException('Route not found');
    }

    private function initController($class)
    {
        $viewFactory = new ViewFactory($this->route->getModule());
        $controller = new $class($viewFactory);
        $controllerMethod = $this->route->getAction() . 'Action';

        if (method_exists($controller, $controllerMethod)) {
            $controller->{$controllerMethod}($this->args, $this->route);
        } else {
            if (!method_exists($controller, 'indexAction')) {
                throw new ActionControllerException(
                    sprintf('Undefined action %s', $this->route->getAction()));
            }

            $controller->indexAction($this->args, $this->route);
        }
    }
}
