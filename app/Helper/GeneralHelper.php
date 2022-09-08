<?php


use Illuminate\Http\Response;

function dictionaryDefault(): array
{
    return[
        'id' => 0,
        'value' => 'not found',
        'meta' => ['color' => 'danger']
    ];
}
