<?php

namespace App\Enums\Enums;

enum ProductSortingOptions : string
{
    case ID = 'id';
    case TITLE = 'title';
    case PRICE = 'price';
    case DISCOUNT_PERCENTAGE = 'discountPercentage';
    case RATING = 'rating';
    case STOCK = 'stock';
}
