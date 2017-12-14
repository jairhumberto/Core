<?php
/**
 * Squille Core (https://github.com/jairhumberto/Core)
 *
 * MIT License
 *
 * Copyright (c) 2018 jairhumberto
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
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
        $file = dirname($_SERVER['DOCUMENT_ROOT'])
                . DIRECTORY_SEPARATOR . 'source'
                . DIRECTORY_SEPARATOR . $this->module
                . DIRECTORY_SEPARATOR . 'view'
                . DIRECTORY_SEPARATOR . $this->file;

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
