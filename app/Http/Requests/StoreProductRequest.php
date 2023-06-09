<?php

namespace App\Http\Requests;

use App\Models\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'price' => [
                'numeric',
                'required',
            ],
            'category' => [
                'array',
            ],
            'category.*.id' => [
                'integer',
                'exists:product_categories,id',
            ],
            'tag' => [
                'array',
            ],
            'tag.*.id' => [
                'integer',
                'exists:product_tags,id',
            ],
            'photo' => [
                'array',
                'nullable',
            ],
            'photo.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'products_count' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],
        ];
    }
}