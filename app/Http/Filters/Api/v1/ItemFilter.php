<?php

namespace App\Http\Filters\Api\V1;


class ItemFilter extends QueryFilter
{

   public function category($values)
   {
      if (!is_array($values)) {
         $values = explode(',', $values);
      }

      foreach ($values as $value) {
         $this->builder->whereHas('categories', function ($query) use ($value) {
            $query->where('categories.name', $value);
         });
      }

      return $this->builder;
   }
   
}
