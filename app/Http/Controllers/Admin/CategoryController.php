<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller {
    /**
     * Handle the incoming request.
     */
    public function __invoke() {
        $categories = Category::query();

        $categories = request()->input("sortBy") === "oldest"
            ? $categories->oldest()
            : $categories->latest();

        return response($categories->get());
    }
}
