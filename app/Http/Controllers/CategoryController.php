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

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   */
  public function update(GenericCreateRequest $req, $id)
  {
    $category = Category::get($id);
    $category->update($req->all());
    return $this->json($category);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   */
  public function destroy($id)
  {
    Category::get($id)->destroy();
    return $this->json();
  }
}