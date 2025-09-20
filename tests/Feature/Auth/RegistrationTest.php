<?php

namespace Tests\Feature\Auth;

use App\Models\Account\Account;
use App\Models\Module\Module;
use App\Models\User\User;
use App\Models\User\UserWorkspace;
use App\Models\Workspace\Workspace;
use App\Supports\UserSupport;
use Database\Seeders\DictionaryColorsSeeder;
use Database\Seeders\DictionaryIconsSeeder;
use Database\Seeders\LanguageSeeder;
use Database\Seeders\ModuleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    //use RefreshDatabase;

    public function test_new_users_can_register()
    {
        $this->seed([
            LanguageSeeder::class,
            ModuleSeeder::class,
            DictionaryColorsSeeder::class,
            DictionaryIconsSeeder::class
        ]);

        $response = $this->post('/register', [
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'language' => 'ru',
        ], [
            'origin' => 'https://app.usenotes.space'
        ]);

        $this->assertAuthenticated();

        /**
         * Account relations
         */

        $account = Account::all()->first();

        $this->assertNotEmpty($account, '- Accounts has not been created');

        $this->assertNotEmpty($account->settings->first(), '- Accounts Settings has not been created');

        /**
         * User relations
         */

        $user = User::where('email', 'test@test.com')->first();

        $this->assertNotEmpty($user, '- Users has not been created');

        $this->assertNotEmpty($user->profile, '- Users Profile has not been created');

        $this->assertNotEmpty(UserSupport::getAccountSettings($user), '- Users Settings has not been created');

        $this->assertNotEmpty(UserSupport::getAccount($user), '- Users Accounts has not been created or not active');

        /**
         * Workspace relations
         */

        $workspace = Workspace::where('module_id', Module::ofCode(Module::MODULE_ENOTE)->first('id')->getId())
            ->where('owner_id', $user->id)
            ->first();

        $this->assertNotEmpty($workspace, '- Workspace Enote for user has not been created #1');

        $userOfWorkspace = UserWorkspace::where('user_id', $user->id)->where('workspace_id', $workspace->id)->first();

        $this->assertNotEmpty($userOfWorkspace, '- Workspace Enote for user has not been created #2');

        $response->assertNoContent();
    }
}
