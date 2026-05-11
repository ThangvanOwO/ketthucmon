<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_hien_thi_trang_dang_ky(): void
    {
        $response = $this->get(route('register'));
        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }

    public function test_dang_ky_thanh_cong(): void
    {
        $response = $this->post(route('register'), [
            'email' => 'new@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertDatabaseHas('users', [
            'email' => 'new@test.com',
            'role' => 'user',
        ]);
        $this->assertAuthenticated();
    }

    public function test_dang_ky_email_khong_hop_le(): void
    {
        $response = $this->post(route('register'), [
            'email' => 'invalid-email',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_dang_ky_password_khong_khop(): void
    {
        $response = $this->post(route('register'), [
            'email' => 'test@test.com',
            'password' => 'password123',
            'password_confirmation' => 'different',
        ]);

        $response->assertSessionHasErrors('password');
    }

    public function test_dang_ky_email_da_ton_tai(): void
    {
        User::create(['email' => 'exists@test.com', 'password' => Hash::make('x'), 'role' => 'user']);

        $response = $this->post(route('register'), [
            'email' => 'exists@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_hien_thi_trang_dang_nhap(): void
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    public function test_dang_nhap_thanh_cong(): void
    {
        User::create([
            'email' => 'user@test.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        $response = $this->post(route('login'), [
            'email' => 'user@test.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticated();
    }

    public function test_dang_nhap_sai_mat_khau(): void
    {
        User::create([
            'email' => 'user@test.com',
            'password' => Hash::make('correct'),
            'role' => 'user',
        ]);

        $response = $this->post(route('login'), [
            'email' => 'user@test.com',
            'password' => 'wrong',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_dang_xuat(): void
    {
        $user = User::create([
            'email' => 'user@test.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        $response = $this->actingAs($user)->post(route('logout'));

        $response->assertRedirect(route('home'));
        $this->assertGuest();
    }
}
