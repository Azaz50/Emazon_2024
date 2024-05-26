<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Mail\UserRegistered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRegistraionMailTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::find(1);

        $this->assertNotNull($user);
        $registration_mail = new UserRegistered($user);
        Mail::to($user)->send($registration_mail);

        $this->assertTrue(true);
    }
}