<?php
/**
 * Squille PHP Framework (http://squille.com/squille-php-framework)
 *
 * @copyright Copyright (c) 2017 Squille
 * @license   this software is distributed under MIT license, see the
 * *            license.mit file
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

    // TODO: Remover configuração.
    public function init()
    {
        $route = $this->parseRoute($this->args->get('path'));
        $configModule = include SOURCE_DIR . $route->getModule() . DS
                        . 'config' . DS . 'config.php';
        
        $module = new Module($route, $this->args, $configModule);
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
