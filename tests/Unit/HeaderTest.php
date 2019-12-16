<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HeaderTest extends TestCase
{

    /**
     * Comprueba que la ruta /resultados redirige a /login
     * cuando el usuario no esta logeado en la aplicacion 
     *
     * @return void
     */
    public function test_ruta_resultados_cuando_no_logeado()
    {

        $response = $this->get('/resultados');
        $response->assertRedirect('login');
    }

    /**
     * Comprueba se accede a la ruta /resultados de manera correcta
     * cuando el usuario esta logeado con rol de estudiante
     */
    public function test_ruta_resultados_cuando_logeado_como_estudiante()

    {
        //TODO: crear entidad de base de datos dinamica y probar usuario
        //add user to dynamic db
        $response = $this->get('/resultados');
        $response->assertRedirect('resultados');
    }

    /**
     * Comprueba que la ruta /crearvotacion redirige a /login 
     * cuando el usuario no esta logeado en la aplicacion
     * 
     * @return void 
     */
    public function test_ruta_votar_cuando_no_logeado()
    {
        //TODO: Esta prueba fallará, vista "votar" aun no hecha
        $response = $this->get('/votar');
        $response->assertRedirect('login');
    }

    /**
     * Comprueba que se accede a la ruta /votar de manera correcta 
     * cuando el usuario esta logeado 
     * 
     * @return void
     */
    public function test_ruta_votar_cuando_logeado_como_estudiante()
    {
        //TODO: Esta prueba fallará, vista "votar" aun no hecha
        //TODO: crear instancia de base de datos, insertar usuario
        $response = $this->get('/votar');
        $response->assertViewIs('votar');
    }

    /**
     * Comprueba que la ruta /roles redirige a /login cuando 
     * el usuario no esta logeado en la aplicacion
     * 
     * @return void
     */
    public function test_ruta_roles_cuando_no_logeado()
    {
        $response = $this->get('/roles');
        $response->assertRedirect('login');
    }

    /**
     * Comprueba que la ruta /roles redirige a la ruta
     * principal cuando el usuario esta logeado con rol de 
     * estudiante
     * 
     * @return void
     */
    public function test_ruta_roles_cuando_logeado_como_estudiante()
    {
        $response = $this->get('/roles');
        $response->assertViewIs('roles');
    }

    /**
     * Comprueba que la ruta /crearvotaciones redirige a /login
     * cuando el usuario no esta logeado en la aplicacion
     * 
     * @return void
     */
    public function test_ruta_crearvotacion_cuando_no_logeado()
    {
        $response = $this->get('/crearvotacion');
        $response->assertRedirect('login');
    }

    public function test_ruta_rincipal_redirige_vista_principal()
    {
        $response = $this->get('/');
        $response->assertViewIs('index');
    }

    public function test_ruta_login_redirige_login()
    {
        $response = $this->get('/login');
        $response->assertViewIs('login');
    }

    public function test_ruta_logout_redirige_login()
    {
        $response = $this->get('/logout');
        $response->assertRedirect('login');
    }
}
