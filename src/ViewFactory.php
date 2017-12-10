<?php
/**
 * Squille PHP Framework (http://squille.com/squille-php-framework)
 *
 * @copyright Copyright (c) 2017 Squille
 * @license   this software is distributed under MIT license, see the
 * *            license.mit file
 */

namespace Squille\Core;

class ViewFactory
{
    private $module;

    public function __construct($module)
    {
        $this->module = $module;
    }

    public function create($view)
    {
        $view = new View($this->module, $view);
        return $view;
    }
}
