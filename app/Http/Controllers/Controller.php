<?php

namespace App\Http\Controllers;

use App\Lib\StrongParameter;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  /*
   * STRONG PARAMETER
   * Please always use this function if you're accessing $request->all()
   *
   * @param         Request
   *
   * @return        array         Whitelist array
   */
  protected function strongParams(Request $request, array $whiteList) {
    return (new StrongParameter($request->all(), $whiteList))->run();
  }

}
