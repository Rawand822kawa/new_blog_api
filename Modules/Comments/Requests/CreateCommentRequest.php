<?php
namespace Modules\Comments\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'comment' => 'required',
        ];
    }
}
