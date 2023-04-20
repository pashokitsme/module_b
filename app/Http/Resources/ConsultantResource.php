<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConsultantResource extends JsonResource
{
  public static function from($req)
  {
    return [
      'user' => $req->user,
      'organization' => $req->organization
    ];
  }
}