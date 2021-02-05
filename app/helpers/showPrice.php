<?php
function showPrice($price)
{
    return 'PHP ' . number_format((float)$price, 2, '.', '');
}
