<?php

namespace App\Rules\Item;

use App\Models\Item;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckItemQuantity implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $orders, Closure $fail): void
    {
        foreach($orders as $order){
            $itemId = $order["attributes"]["id"];
            $item = Item::find($itemId);

            if($item['quantity'] < $order["attributes"]["quantity"]){
                $fail("The quantity cannot exceed the available stock.");
            }
        }
    }
}
