<?php

namespace Tests\Feature;

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    /**
     * @test
     */
    public function testIndexMethodReturnsView(): void
    {
        $controller = new ProductController();
        $request = Request::create('/products');

        $response = $controller->index($request);

        $this->assertInstanceOf(View::class, $response);
    }

    /**
     * @test
     */
    public function testShowMethodReturnsView(): void
    {
        $controller = new ProductController();
        $ids = '548,549,550,551,552,553,554,555,556,557,558,559,560,561,562';
        $response = $controller->show($ids);

        $this->assertInstanceOf(View::class, $response);
    }
}
