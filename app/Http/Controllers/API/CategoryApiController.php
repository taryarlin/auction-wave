<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

class CategoryApiController extends Controller
{
    public function getAllCategories () {
        $categories = Category::get();

        $data = CategoryResource::collection($categories)->additional(['code' => 200, 'result' => 1, 'message' => 'Success']);

        return $data;
    }
}
