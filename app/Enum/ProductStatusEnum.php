<?php

namespace App\Enum;

enum ProductStatusEnum: string
{
    case IN_STOCK = 'in stock';
    case SOLD_OUT = 'sold out';
    case COMING_SOON = 'coming soon';
}
