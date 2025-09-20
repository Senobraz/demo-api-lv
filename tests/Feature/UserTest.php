<?php

namespace Tests\Feature;

use App\Supports\AppearanceSupport;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_update_user_account_appearance(): void
    {
        $this->authorize();

        $link = URL::route('account.update-appearance-settings');

        $response = $this->put($link, [
            'appearance_mode' => AppearanceSupport::APPEARANCE_MODE_LIGHT,
            'appearance_color' => 'olive',
        ]);

        $response->assertStatus(200);
    }

    public function test_update_user_account_basic_settings(): void
    {
        $this->authorize();

        $link = URL::route('account.update-basic-settings');

        $response = $this->put($link, [
            'language' => 'en',
            'timezone' => 'Europe/Moscow',
            'date_format' => 'd/m/Y',
            'time_format' => 'h:i a',
            'week_start' => 0,
        ]);

        $response->assertStatus(200);
    }

    public function test_update_user_avatar(): void
    {
        $this->authorize();

        $link = URL::route('profile.update-avatar');

        $response = $this->put($link, [
            'avatar_color' => '#F15C3C',
            'avatar_icon_ulid' => '01haajpveakkzzrydxef6897ck',
        ]);

        $response->assertStatus(200);
    }

    public function test_update_user_username(): void
    {
        $this->authorize();

        $link = URL::route('profile.update-name');

        $response = $this->put($link, [
            'username' => 'Test Username',
        ]);

        $response->assertStatus(200);
    }

    public function test_update_user_password(): void
    {
        $this->authorize();

        $link = URL::route('profile.update-password');

        $response = $this->put($link, [
            'password' => 'password',
            'password_confirmation' => 'password',
            'password_current' => 'password',
        ]);

        $response->assertStatus(200);
    }
}
