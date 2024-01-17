<?php

namespace Tests\Feature;

use App\Http\Controllers\DashboardController;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    public function testIndexMethodReturnsRedirectResponse()
    {
        $controller = new DashboardController();

        $response = $controller->index();

        $this->assertInstanceOf(RedirectResponse::class, $response);
    }

    public function testDashboardMethodReturnsView()
    {
        $controller = new DashboardController();

        $response = $controller->dashboard();

        $this->assertInstanceOf(View::class, $response);
    }
}
