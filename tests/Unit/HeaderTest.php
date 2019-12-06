<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HeaderTest extends TestCase
{
    /**
     * Test that the Title button loods the main page
     *
     * @return void
     */
    public function test_boton_titulo()
    {
        $response = $this->get('/');
        $response->assertViewIs('index');
    }

    public function test_boton_login()
    {
        $response = $this->get('/login');
        $response->assertViewIs('login');
    }

    public function test_boton_logout()
    {
        $response = $this->get('/logout');
        $response->assertRedirect('login');
    }
}
