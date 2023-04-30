<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenericCreateRequest;
use App\Models\Category;

class CategoryController extends Controller
{
  public function index()
  {
    return $this->json(Category::all()->all());
  }

  public function store(GenericCreateRequest $req)
  {
    $category = Category::create($req->all());
    $category->save();
    return $this->json($category);
  }

  public function update(GenericCreateRequest $req, $id)
  {
    $category = Category::get($id);
    $category->update($req->all());
    return $this->json($category);
  }

  public function destroy($id)
  {
    Category::get($id)->destroy();
    return $this->json();
  }
}