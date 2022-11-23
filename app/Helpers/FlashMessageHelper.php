<?php

namespace App\Helpers;

class FlashMessageHelper
{
    const BLANK = ' ';

    const GENERAL_ERROR = 'There was a problem';

    const TEST_BOOKING_SUCCESSFUL = 'Your test has been booked! Do you want to view your cart and checkout?';

    const GENERAL_ENQUIRY_REQUEST_SUCCESSFUL =
        'Thank you for reaching out. Your request has been sent and we will respond soon';

    const QUOTE_ENQUIRY_REQUEST_SUCCESSFUL = 'We will get in touch with you for a quote!';

    const PRODUCT_ADD_TO_CART_SUCCESSFUL = 'Product Added! Please View your cart to checkout';

    const ORDER_BOOKING_SUCCESSFUL = 'Your order has been booked! You will receive a confirmation email soon.';

    const PAYSTACK_ERROR = 'The paystack token has expired. Please refresh the page and try again.';
}
