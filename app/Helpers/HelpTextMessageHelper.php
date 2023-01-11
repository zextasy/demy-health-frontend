<?php

namespace App\Helpers;

class HelpTextMessageHelper
{
    const BLANK = ' ';

    const DEFAULT_SUCCESS_MESSAGE = 'Success!';
    const DEFAULT_ERROR_MESSAGE = 'Something went wrong!';
    public const REFERENCE_HELPER_MSG =
        'Reference number for the patient. Leave this blank and the system will generate one for you';
    public const CHANGE_EMAIL_ACTION_MODAL_SUBHEADING =
        'This will change the email for the patient and all associated entities.'
        .'Including test bookings, test results, orders and invoices.';
}
