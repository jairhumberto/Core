<?php
/**
 * Squille Core (https://github.com/jairhumberto/Core)
 *
 * @copyright Copyright (c) 2018 Squille
 * @license   this software is distributed under MIT license, see the
 *            LICENSE file.
 */

namespace Squille\Core;

class View
{
    private $module;
    private $file;
    private $variables;

    public function __construct($module, $file)
    {
        $this->module = $module;
        $this->file = $file;
        $this->variables = new Collection();
    }

    public function addVariable($variable, $value)
    {
        $this->variables->add($variable, $value);
    }

    public function display()
    {
        $file = SOURCE_DIR . $this->module . DS . 'view' . DS . $this->file;

        if (! file_exists($file)) {
            throw new ViewException(sprintf('file %s not found', $file));
        }

        // Declarando as variáveis do template.
        foreach ($this->variables as $variable => $value) {
            $$variable = $value;
        }

        include $file;
    }
}
