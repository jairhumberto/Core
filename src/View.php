<?php
/**
 * Squille PHP Framework (http://squille.com/squille-php-framework)
 *
 * @copyright Copyright (c) 2017 Squille
 * @license   this software is distributed under MIT license, see the
 * *            license.mit file
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
