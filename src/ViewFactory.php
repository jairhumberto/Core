<?php
/**
 * Squille Core (https://github.com/jairhumberto/Core)
 *
 * @copyright Copyright (c) 2018 Squille
 * @license   this software is distributed under MIT license, see the
 *            LICENSE file.
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
