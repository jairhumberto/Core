<?php
/**
 * Squille Core (https://github.com/jairhumberto/Core)
 *
 * @copyright Copyright (c) 2018 Squille
 * @license   this software is distributed under MIT license, see the
 *            LICENSE file
 */

namespace Squille\Core;

abstract class ActionController
{
    private $viewFactory;

    public function __construct(ViewFactory $viewFactory)
    {
        $this->viewFactory = $viewFactory;
    }

    public function getViewFactory()
    {
        return $this->viewFactory;
    }
}
