<?php

namespace ZF\Doctrine\QueryBuilder\Filter\ODM;

class Equals extends AbstractFilter
{
    public function filter($queryBuilder, $metadata, $option)
    {
        $queryType = 'addAnd';
        if (isset($option['where'])) {
            if ($option['where'] == 'and') {
                $queryType = 'addAnd';
            } elseif ($option['where'] == 'or') {
                $queryType = 'addOr';
            }
        }

        $format = null;
        if (isset($option['format'])) {
            $format = $option['format'];
        }

        $value = $this->typeCastField($metadata, $option['field'], $option['value'], $format);

        $queryBuilder->$queryType($queryBuilder->expr()->field($option['field'])->equals($value));
    }
}
