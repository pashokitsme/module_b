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
  public function all($regionId, $branchId)
  {
    $consulatants = Consultant::all()->all();
    return $this->json([ConsultantResource::class, 'from'], $consulatants);
  }

  public function store(CreateConsultantRequest $req, $regionId, $branchId): JsonResponse
  {
    Region::get($regionId)->branch($branchId);
    $consultant = Consultant::create($req->merge(['name' => $req->firstname . ' ' . $req->secondname, 'branch_id' => $req->organization_id]));
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