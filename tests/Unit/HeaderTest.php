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
    public function testBotonResultadosCuandoNoLogeado()
    {

        $response = $this->get('/resultados');
        $response->assertRedirect('login');
    }

    /**
     * Comprueba se accede a la ruta /resultados de manera correcta
     * cuando el usuario esta logeado con rol de estudiante
     */
    public function testRutaResultadosCuandoLogeadoComoEstudiante()
    {
        //TODO: crear entidad de base de datos dinamica y probar usuario
        //add user to dynamic db
        $response=$this->get('/resultados');
        $response->assertRedirect('/');
    }

    /**
     * Comprueba que la ruta /crearvotacion redirige a /login 
     * cuando el usuario no esta logeado en la aplicacion
     * 
     * @return void 
     */
    public function testRutaVotarCuandoNoLogeado()
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
    public function testRutaVotarCuandoLogeadoComoEstudiante()
    {
        //TODO: Esta prueba fallará, vista "votar" aun no hecha
        //TODO: crear instancia de base de datos, insertar usuario
        $response=$this->get('/votar');
        $response->assertViewIs('votar');
    }

    /**
     * Comprueba que la ruta /roles redirige a /login cuando 
     * el usuario no esta logeado en la aplicacion
     * 
     * @return void
     */
    public function testRutaRolesCuandoNoLogeado()
    {
        $response=$this->get('/roles');
        $response->assertRedirect('login');
    }

    /**
     * Comprueba que la ruta /roles redirige a la ruta
     * principal cuando el usuario esta logeado con rol de 
     * estudiante
     * 
     * @return void
     */
    public function testRutaRolesCuandoLogeadoComoEstudiante()
    {
        
    }

    /**
     * Comprueba que la ruta /crearvotaciones redirige a /login
     * cuando el usuario no esta logeado en la aplicacion
     * 
     * @return void
     */
    public function testRutaCrearVotacionCuandoNoLogeado()
    {
        $response=$this->get('/crearvotacion');
        $response->assertRedirect('login');
    }
    
}
