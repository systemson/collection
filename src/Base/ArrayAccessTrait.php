<?php

namespace Amber\Collection\Base;

trait ArrayAccessTrait
{
    public $vector;

    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->vector[] = $value;
        } else {
            $this->vector[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->vector[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->vector[$offset]);
    }

    public function offsetGet($offset) {
        return $this->vector[$offset] ?? null;
    }
}
