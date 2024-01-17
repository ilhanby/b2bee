<?php

namespace App\Http\Controllers;

use App\Http\Services\TSOFT;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    private static TSOFT $tsoft;

    public function __construct()
    {
        self::$tsoft = new TSOFT();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $start = $request->start ?? 0;
        $limit = $request->limit ?? 500;

        $categories = self::$tsoft->getCategories($start, $limit);

        return view('categories.index', compact('categories'));
    }
}
