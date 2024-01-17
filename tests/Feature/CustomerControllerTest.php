<?php

namespace Tests\Feature;

use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{

    /**
     * @test
     */
    public function testIndexMethodReturnsView(): void
    {
        $controller = new CustomerController();
        $request = Request::create('/customers');

        $response = $controller->index($request);

        $this->assertInstanceOf(View::class, $response);
    }
}
