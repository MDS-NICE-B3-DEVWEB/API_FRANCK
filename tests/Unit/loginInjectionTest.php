<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class loginInjectionTest extends TestCase
{
    use RefreshDatabase;

    public function testSQLInjection()
    {
        //Login avec une injection sql dedans
        $malicious = "' OR '1'='1";
        $response = $this->post('/login', [
            'username' => 'test',
            'password' => $malicious,
        ]);

        // Verifier que l'utilisateur n'est pas authentifié
        $this->assertGuest();

        // //Login avec une injection sql dedans
        // $password = "Azertyuiop9!";
        // $response = $this->post('/login', [
        //     'username' => 'test',
        //     'password' => $password,
        // ]);
        // //Verifier que l'utilisateur est pas authentifié
        // $this->assertAuthenticated();

        // le login ne fonctionne pas même si je met les bonnes informations voir si il faut pas creer l user avant
        //a finir
    }
}