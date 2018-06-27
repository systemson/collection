<?php

namespace Amber\Collection\Engine;

use  Amber\Collection\Collection;

trait Statements
{
    public $filterBy;
    public $condition;
    public $order;

    public function clone()
    {
        return new Collection($this->vector);
    }

    public function select(...$columns)
    {
        $vector = $this->vector->map(function ($value) use ($columns) {
            $result = [];

            foreach ($columns as $column) {

                if (isset($value[$column])) {
                    $result[] = $value[$column];
                }
            }

            return $result;
        });

        return new Collection($vector);
    }

    public function where($column, $condition)
    {
        $vector = $this->vector->filter(function ($value) use ($column, $condition) {

            if (isset($value[$column])) {
                return $value[$column] == $condition;
            }

            return;
        });

        return new Collection($vector);
    }

    public function orderBy($column, $order = 'asc')
    {
        $vector = $this->vector->sort(function ($a, $b) use ($column) {

            return $a[$column] <=> $b[$column];
        });

        return new Collection($vector);
    }

    public function groupBy($column)
    {
        return $this;
    }
}
