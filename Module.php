<?php
/**
 * Squille PHP Framework (http://squille.com/squille-php-framework)
 *
 * @copyright Copyright (c) 2017 Squille
 * @license   this software is distributed under MIT license, see the license.mit file
 */

namespace Squille\Core;

class Module {
    private $route;
    private $args;
    private $config;

    public function __construct(Route $route, Collection $args, $config) {
        $this->route = $route;
        $this->args = $args;
        $this->config = $config;
    }

    public function init() {
        foreach ($this->config['routes'] as $route => $class) {
            if (preg_match('~' . $route . '(/.*)*$~', $this->args->get('path'))) {
                $this->initController($class);
                return;
            }
        }
        
        throw new ModuleException('Route not found');
    }

    private function initController($class) {
        $viewFactory = new ViewFactory($this->route->getModule());
        $controller = new $class($viewFactory);
        $controllerMethod = $this->route->getAction() . 'Action';

        if (method_exists($controller, $controllerMethod)) {
            $controller->{$controllerMethod}($this->args, $this->route);
        } else {
            if (!method_exists($controller, 'indexAction')) {
                throw new ActionControllerException(sprintf('Undefined action %s', $this->route->getAction()));
            }
			
			$controller->indexAction($this->args, $this->route);
        }
    }
}
