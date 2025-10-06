<?php

namespace App\Enums;

class UrlTypesEnum
{


    public const PAGES = 'pages';
    public const SHOP = 'shop';
    public const EVENTS = 'events';
    public const LANDSCAPE = 'landscape';
    public const PRODUCTS = 'products';
    public const CONTACTUS = 'contact us';


    public static function values(): array
    {

        return [
            static::PAGES => 'pages',
            static::SHOP => 'shop',
            static::EVENTS => 'events',
            static::LANDSCAPE => 'landscape',
            static::PRODUCTS => 'products',
            static::CONTACTUS => 'contact us',
        ];
    }

}
