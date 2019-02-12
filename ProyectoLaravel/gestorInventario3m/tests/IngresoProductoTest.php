<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IngresoProductoTest extends TestCase
{
    /**
     * A basic test example.
     * @return void
     */
    public function testLogin()
    {
    		$this->visit('/')
    		 ->dontSee('ErrorException')
    		 ->see('3 Marias')
    		 ->type('juan@gmail.com','email')
    		 ->type('123546','password')
    		 ->press('Ingresar');
    }
    /**
     * A basic test example.
     * @return void
     */
    public function testRegistroCliente()
    {
    	$this->visit('/')
    		 ->dontSee('ErrorException')
    		 ->see('3 Marias')
    		 ->type('juan@gmail.com','email')
    		 ->type('123546','password')
    		 ->press('Ingresar')
    		 ->visit('/almacen/categoria/create');
}
    /**
     * A basic test example.
     * @return void
     */
    public function testSeeHome()
    {
    		$this->visit('/inicio/inicio')
    		 ->dontSee('ErrorException')
    		 ->see('3 Marias');
    }




    
}
