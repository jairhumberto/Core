<?php
/**
 * Squille PHP Framework (http://squille.com/squille-php-framework)
 *
 * @copyright Copyright (c) 2017 Squille
 * @license   this software is distributed under MIT license, see the
 * *            license.mit file
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
