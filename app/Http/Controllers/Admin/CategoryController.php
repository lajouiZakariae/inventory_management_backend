<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Response;
use Spatie\RouteAttributes\Attributes\Get;

class CategoryController extends Controller
{

    #[Get('/categories')]
    public function index(): Response
    {
        $categories = Category::query();

        $categories = request()->input("sortBy") === "oldest"
            ? $categories->oldest()
            : $categories->latest();

        return response($categories->get());
    }
}
