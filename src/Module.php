<?php
/**
 * Squille Core (https://github.com/jairhumberto/Core)
 *
 * @copyright Copyright (c) 2018 Squille
 * @license   this software is distributed under MIT license, see the
 *            LICENSE file
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
