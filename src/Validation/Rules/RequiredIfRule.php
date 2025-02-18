<?php

namespace Scandiweb\Validation\Rules;

use Scandiweb\Validation\Rules\Rule;

class RequiredIfRule implements Rule
{
    protected string $otherField;
    protected $expectedValue;

    public function __construct(string $otherField, $expectedValue)
    {
        $this->otherField = $otherField;
        $this->expectedValue = $expectedValue;
    }

    public function apply($field, $value, $data = []): bool
{
    // Only check if the field exists in the data.
    if (!array_key_exists($field, $data)) {
        // Field is not submitted at all, so consider it valid.
        return true;
    }

    if (isset($data[$this->otherField]) && $data[$this->otherField] == $this->expectedValue) {
        return !empty($value);
    }
    return true;
}


    public function __toString()
    {
        return "%s is required when {$this->otherField} is {$this->expectedValue}";
    }
}
