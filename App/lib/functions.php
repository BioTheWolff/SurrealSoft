<?php

function e(string $s): string
{
    return htmlspecialchars($s);
}

function d(string $s): string
{
    return htmlspecialchars_decode($s);
}



function re(string $s): string
{
    return rawurlencode($s);
}

function rd(string $s): string
{
    return rawurldecode($s);
}