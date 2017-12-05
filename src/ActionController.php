<?php
/**
 * Squille Core (http://core.squille.org)
 *
 * @copyright Copyright (c) 2017 Squille
 * @license   this software is distributed under MIT license
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
