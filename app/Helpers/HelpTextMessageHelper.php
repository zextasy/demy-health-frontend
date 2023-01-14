<?php

namespace App\Helpers;

class HelpTextMessageHelper
{
    const BLANK = ' ';

    const DEFAULT_SUCCESS_MESSAGE = 'Success!';
    const DEFAULT_ERROR_MESSAGE = 'Something went wrong!';
    public const PATIENT_REFERENCE_HELPER_MSG =
        'Reference number for the patient. Leave this blank and the system will generate one for you';
    public const CHANGE_EMAIL_ACTION_MODAL_SUBHEADING =
        'This will change the email for the patient and all associated entities.'
        . 'Including test bookings, test results, orders and invoices.';
    public const NAME_SLUG_TEXT =
        'This is the internal name. It should be all lowercase with underscores instead of spaces';
    public const TEST_RESULT_CUSTOMER_EMAIL_MSG =
        'Leave this blank and the system will use the customer email from the booking';
    public const TEST_TYPE_CALL_IN_MSG =
        'If this is selected, customers will not see the price of this item and will be asked to call in instead';
    public const TEST_TYPE_REFERENCE_HELPER_MSG =
        'Internal unique reference for this test type. Leave blank and the system will generate one for you';
}
