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
    public function testBotonTitulo()
    {
        $response =$this->get('/');
        $response->assertViewIs('index');
    }
}
