<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $rules = [
            'title' => 'required|string|unique:games,title',
            'description' => '',
            'complexity' => 'required|min:1|max:10',
            'minPlayers' => 'required|min:1|max:10',
            'maxPlayers' => 'required|min:1|max:10',
            'isActive' => 'required|boolean',
        ];

        switch($this->getMethod()){
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                    'game_id' => 'required|integer|exists:id',
                    'title' => [
                        'required',
                        Rule::unique('games')->ignore($this->title, 'title'),
                    ],
                ] + $rules;
            case 'DELETE':
                return [
                    'game_id' => 'required|integer|exists:id',
                ];
        }
    }

    public function messages()
    {
        return [
            'date.required' => 'A date is required',
            'date.date_format'  => 'A date must be in format: Y-m-d',
            'date.unique'  => 'This date is already taken',
            'date.after_or_equal'  => 'A date must be after or equal today',
            'date.exists'  => 'This date doesn\'t exists',
        ];
    }

    public function all($keys = null)
    {
        //return $this->all();
        $data = parent::all($keys);
        switch($this->getMethod()){
            case 'DELETE':
                $data['date'] = $this->route('day');
        }
        return $data;
    }
}
