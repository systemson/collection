<?php

namespace Amber\Collection\Base;

use  Amber\Collection\Collection;

trait Statements
{
    /**
     * Returns a new Collection containing the items in the specified column(s).
     *
     * @param array|string $columns The collumns to filter by.
     *
     * @return Collection A new collection.
     */
    public function select(...$columns)
    {
        $vector = $this->container->map(function ($item) use ($columns) {
            $result = [];

            foreach ($columns as $column) {

                if (isset($item[$column])) {
                    $result[$column] = $item[$column];
                }
            }

            return $result;
        });

        return $this->make($vector);
    }

    /**
     * Returns a new Collection containing the items in the specified column that are equal to the especified value.
     *
     * @param string $column The columns to filter by.
     * @param mixed  $value The value to compare each item.
     *
     * @return Collection A new collection.
     */
    public function where($column, $value)
    {
        $vector = $this->container->filter(function ($item) use ($column, $value) {

            if (isset($item[$column])) {
                return $item[$column] === $value;
            }

            return;
        });

        return $this->make($vector);
    }

    /**
     * Returns a new Collection containing the items in the specified column that are not equal to the especified value.
     *
     * @param string $column The columns to filter by.
     * @param mixed  $value The value to compare each item.
     *
     * @return Collection A new collection.
     */
    public function whereNot($column, $value)
    {
        $vector = $this->container->filter(function ($item) use ($column, $value) {

            if (isset($item[$column])) {
                return $item[$column] !== $value;
            }

            return;
        });

        return $this->make($vector);
    }

    /**
     * Returns a new Collection containing the items in the specified column that are equal to the especified value(s).
     *
     * @param string $column The columns to filter by.
     * @param array  $values The values to compare each item.
     *
     * @return Collection A new collection.
     */
    public function whereIn($column, array $values = [])
    {
        $vector = $this->container->filter(function ($item) use ($column, $values) {

            if (isset($item[$column])) {
                return in_array($item[$column], $values);
            }

            return;
        });

        return $this->make($vector);
    }

    /**
     * Returns a new Collection containing the items in the specified column that are not equal to the especified value(s).
     *
     * @param string $column The columns to filter by.
     * @param array  $values The values to compare each item.
     *
     * @return Collection A new collection.
     */
    public function whereNotIn($column, array $value = [])
    {
        $vector = $this->container->filter(function ($item) use ($column, $value) {

            if (isset($item[$column])) {
                return !in_array($item[$column], $value);
            }

            return;
        });

        return new Collection($vector);
    }

    /**
     * Returns a new Collection containing the items ordered by the especified column.
     *
     * @param string $column The column to order by.
     * @param string $order  The order to sort the items.
     *
     * @return Collection A new collection.
     */
    public function orderBy($column, $order = 'ASC')
    {
        $vector = $this->container->sorted(function($a, $b) use ($column, $order){
            if (strtoupper($order) == 'ASC') {
                return $a[$column] <=> $b[$column];
            } elseif (strtoupper($order) == 'DESC') {
                return $b[$column] <=> $a[$column];
            }
        });

        return $this->make($vector);
    }

    /**
     * @todo Must be implemented.
     *
     * @return Collection A new collection.
     */
    public function groupBy($column)
    {
        //return $this;
    }
}
