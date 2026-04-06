<?php

namespace App\Http\Requests\Api\v1\Item;

use App\Rules\Image\CheckOldImages;
use App\Rules\Image\CheckImageAmount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
 
        return [
            "data.attributes.name" => ['required', 'string'],
            "data.attributes.description" => ['required', 'string'],
            "data.attributes.stock" => ['required', 'integer'],
            "data.attributes.comment" => ['string'],
            "data.attributes.projects" => ['array', 'max:5'],
            "data.attributes.categories" => 'array',

            "relationships.categories" => ['array'],
            'relationships.categories.*' => ['exists:categories,id'],

            "relationships.images" => [new CheckImageAmount],
            "relationships.images.old" => ["array", 'required', new CheckOldImages($this->item->id)],
            "relationships.images.new"  => ["array", 'required'],
    
            "relationships.images.old.*" => ['distinct'],
            "relationships.images.new.*" => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }

    public function attributes(): array
    {
        return [
            "data.attributes.name" => 'name',
            "data.attributes.description" => 'description',
            "data.attributes.stock" => 'quantity',
            "data.attributes.comment" => 'comment',
            "data.attributes.projects" => 'projects',

            'relationships.categories' => 'categories',
            'relationships.categories.*' => 'categories',

            "relationships.images" => 'images',

            "relationships.images.old.*" => "images_old",
            "relationships.images.new.*" => "images_new"
        ];
    }
}
