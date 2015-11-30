<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Task extends Model {

  public function scopeActive($query) {
    return $query->where(function($q) {
      return $q->where('completed', false)->orWhere('completed', null);
    });
  }

  public function scopeCompleted($query) {
    return $query->where('completed', true);
  }

}
