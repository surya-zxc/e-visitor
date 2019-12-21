<?php

namespace App\Http\Requests;

use App\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateAreaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('area_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return true;
    }

    public function rules()
    {
        return [
            'nama'    => [
                'required',
            ],
        ];

    }
}