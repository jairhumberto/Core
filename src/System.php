<?php
/**
 * Squille Core (https://github.com/jairhumberto/Core)
 *
 * @copyright Copyright (c) 2018 Squille
 * @license   this software is distributed under MIT license, see the
 *            LICENSE file.
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

        $routeModule = include 'source'
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
