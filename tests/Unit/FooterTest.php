<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FooterTest extends TestCase
{
    /**
     * Test that the Button Accesibilidad loads the correct route
     *
     * @return void
     */
        public function testBotonAccesibilidad()
    {
        $response= $this->get('/accesibilidad');
        $response->assertViewIs('legal.accesibilidad');
    }

    /**
     * Test that the Button Aviso Legal loads the correct route
     *
     * @return void
     */
    public function testBotonAvisoLegal()
    {
        $response= $this->get('/avisolegal');
        $response->assertViewIs('legal.avisolegal');
    }

    /**
     * Test that the Button Cookies loads the correct route
     *
     * @return void
     */
    public function testBotonCookies()
    {
        $response= $this->get('/cookies');
        $response->assertViewIs('legal.cookies');
    }
    
}
