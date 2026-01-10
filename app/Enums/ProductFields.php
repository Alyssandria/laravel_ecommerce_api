<?php

namespace App\Enums;

enum ProductFields : string
{
    case ID = 'id';
    case TITLE = 'title';
    case DESCRIPTION = 'description';
    case CATEGORY = 'category';
    case PRICE = 'price';
    case DISCOUNT_PERCENTAGE = 'discountPercentage';
    case RATING = 'rating';
    case STOCK = 'stock';
    case TAGS = 'tags';
    case BRAND = 'brand';
    case SKU = 'sku';
    case WEIGHT = 'weight';
    case DIMENSIONS = 'dimensions';
    case WARRANTY_INFORMATION = 'warrantyInformation';
    case SHIPPING_INFORMATION = 'shippingInformation';
    case AVAILABILITY_STATUS = 'availabilityStatus';
    case REVIEWS = 'reviews';
    case RETURN_POLICY = 'returnPolicy';
    case MINIMUM_ORDER_QUANTITY = 'minimumOrderQuantity';
    case META = 'meta';
    case THUMBNAIL = 'thumbnail';
    case IMAGES = 'images';
}
