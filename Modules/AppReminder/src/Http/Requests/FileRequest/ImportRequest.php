<?php

namespace Modules\SEO\Http\Requests\FileRequest;
// use Modules\SEO\Http\Requests\FileRequest;


use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**

    
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'import_file' => 'file|mimes:xls,xlsx,csv,txt',
        ];
    }

}
