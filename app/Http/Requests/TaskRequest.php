<?php

namespace App\Http\Requests;

class TaskRequest extends Request {

  public function messages() {
    return [
    ];
  }

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules() {
    switch($this->method()) {
      case 'GET': {
        return [
          'filter'          => ['string']
        ];
      }
      case 'DELETE': {
        return [];
      }
      case 'POST': {
        return [
          'name'            => ['string', 'max:255', 'required']
        ];
      }
      case 'PUT':
      case 'PATCH': {
        return [
          'name'            => ['string'],
          'completed'       => ['boolean']
        ];
      }
      default:break;
    }
  }

}

