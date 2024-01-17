<?php

namespace Tests\Feature;

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    /**
     * @test
     */
    public function testIndexMethodReturnsView(): void
    {
        $controller = new CategoryController();
        $request = Request::create('/categories');

        $response = $controller->index($request);

        $this->assertInstanceOf(View::class, $response);
    }
}
