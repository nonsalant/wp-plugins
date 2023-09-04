<?php

namespace PostsRow;

/**
 * @param string|null
 * @return string|null The modified value with spaces removed.
 */
function remove_spaces($value)
{
    if ($value !== null) {
        return str_replace(' ', '', $value);
    }
    return $value;
}
