<?php

namespace App\Http\Controllers;

use App\Http\Services\TSOFT;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductController extends Controller
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

        $products = self::$tsoft->getProducts($start, $limit);

        return view('products.index', compact('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param string $ids
     * @return View
     */
    public function show(string $ids): View
    {
        $ids = explode(',', $ids);
        $ids = implode('|', $ids);

        $products = self::$tsoft->getProducts(0, 50, $ids);

        return view('products.show', compact('products'));
    }
}
