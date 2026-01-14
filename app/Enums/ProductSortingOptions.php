<?php

namespace App\Enums;


enum ProductSortingOptions : string
{
    case TITLE = 'title';
    case PRICE = 'price';
    case DISCOUNT_PERCENTAGE = 'discountPercentage';
    case RATING = 'rating';
    case STOCK = 'stock';
}
