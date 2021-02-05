<?php
function redirect($address)
{
    return header("Location: $address");
}
