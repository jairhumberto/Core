<?php
/**
 * Squille Core (https://github.com/jairhumberto/Core)
 *
 * @copyright Copyright (c) 2018 Squille
 * @license   this software is distributed under MIT license, see the
 *            LICENSE file.
 */

namespace Squille\Core;

class Collection extends \ArrayIterator
{
    public function add($index, $value)
    {
        $this->offsetSet($index, $value);
    }

    public function get($index)
    {
        return @$this->offsetGet($index);
    }

    public function getFirst()
    {
        foreach ($this as $value) {
            return $value;
        }
    }

    public function getLast()
    {
        foreach ($this as $value) {
            $r = $value;
        }

        return $r;
    }

    public function valueExists($needle)
    {
        foreach ($this as $key => $value) {
            if ($needle == $value) {
                return $key;
            }
        }

        return false;
    }

    public function keyExists($needle)
    {
        foreach ($this as $key => $value) {
            if ($needle == $key) {
                return $value;
            }
        }

        return false;
    }
}
