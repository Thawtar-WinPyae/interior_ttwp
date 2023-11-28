<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ImageSizeValidationRule implements Rule
{
    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function passes($attribute, $value)
    {
        list($width, $height) = getimagesize($value);

        if ($this->order == 1 && $width == 300 && $height == 500) {
            return true;
        } elseif (($this->order == 2 || $this->order == 3) && $width == 250 && $height == 300) {
            return true;
        } elseif ($this->order == 4 && $width == 250 && $height == 110) {
            return true;
        }

        return false;
    }

    public function message()
    {
        return 'Invalid image size for the given order.';
    }
}
