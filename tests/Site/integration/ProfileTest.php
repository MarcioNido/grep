<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Site\Profile;

class ProfileTest extends TestCase
{

    /** @test */
    public function a_default_profile_is_created_if_not_exist()
    {
        $profile = Profile::getInstance();
        $this->assertNotNull($profile);
        $this->assertTrue($profile->has_profile);
        $this->assertEquals('Apartamento', $profile->tipo_imovel);
    }

    /** @test */
    public function profile_is_updated_when_requested()
    {
        $profile = Profile::getInstance();
        $profile->tipo_imovel = "Casa";

        $this->assertEquals('Casa', $profile->tipo_imovel);
    }

}
