<?php
function generateSlug($string)
{
    return url_title($string, '-', true);
}
