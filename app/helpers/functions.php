<?php
function flash($message = null)
{
    $alert = app('alert');
    if (!is_null($message)) {
        return $alert->info($message);
    }
    return $alert;
}
