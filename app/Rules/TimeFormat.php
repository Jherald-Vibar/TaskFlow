<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TimeFormat implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^([01]?[0-9]|2[0-3]):([0-5][0-9])$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be in the format HH:MM (24-hour format).';
    }
}
