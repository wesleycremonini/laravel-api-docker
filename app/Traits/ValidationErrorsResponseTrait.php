<?php

namespace App\Traits;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response as Status;


trait ValidationErrorsResponseTrait
{
  protected function errors(FormRequest $request)
  {
      $error = $request->validator->errors()->messages();
      return response()->json(['error' => $error], Status::HTTP_BAD_REQUEST);
  }
}
