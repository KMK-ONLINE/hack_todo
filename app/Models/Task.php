<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Task extends Model {

  public $errors;

  private $rules = [
    'name' => 'required|max:255'
  ];

  public function isValid() {
    $data = $this->getAttributes();

    $validator =  Validator::make($data, $this->rules);
    $success      = $validator->passes();
    $this->errors = $validator->errors(); 

    return $success;
  }

}
