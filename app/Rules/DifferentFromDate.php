<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DifferentFromDate implements Rule
{
    protected $fromDate;

    public function __construct($fromDate)
    {
        $this->fromDate = $fromDate;
    }

    public function passes($attribute, $value)
    {
        return $value != $this->fromDate;
    }

    public function message()
    {
        return 'The :attribute must be different from the from date.';
    }
}
