<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateConsultantRequest;
use App\Http\Resources\ConsultantResource;
use App\Models\Consultant;
use App\Models\Region;
use App\Models\Role;
use App\Models\User;
use Symfony\Component\HttpFoundation\JsonResponse;

class ConsultantController extends Controller
{
  public function all($regionId, $orgId)
  {
    $consulatants = Consultant::all()->all();
    return $this->json([ConsultantResource::class, 'from'], $consulatants);
  }

  public function store(CreateConsultantRequest $req, $regionId, $orgId): JsonResponse
  {
    $org = Region::get($regionId)->organization($orgId);
    $user = User::create($req->merge(['name' => $req->firstname . ' ' . $req->secondname, 'role_id' => Role::CONSULTANT]));
    $user->save();
    $consultant = Consultant::create(['user_id' => $user->id, 'organization_id' => $org->id]);
    $consultant->save();
    return $this->json(ConsultantResource::from($consultant));
  }

// public function update(CreateConsultantRequest $req, $userId)
// {
//   $user = User::get($userId);
//   $user->update($req->merge(['name' => $req->firstname . ' ' . $req->secondname, 'role_id' => Role::CONSULTANT]));
//   return $this->json('')

// }
}