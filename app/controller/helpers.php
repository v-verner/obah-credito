<?php defined('ABSPATH') || exit;

function vv_log($thing, bool $onlyForDev = true): void
{
    if ($onlyForDev && !OBAH_DEV) :
        return;
    endif;

    error_log(print_r($thing, true));
}
