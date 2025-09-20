<?php

namespace App\Actions\Accounts;

use App\Actions\ApiAction;
use App\Http\Resources\Account\AccountResource;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserSettingsResource;
use App\Http\Resources\Workspace\WorkspaceResource;
use App\Models\Account\Account;
use App\Models\User\User;
use App\Models\User\UserSettings;
use App\Supports\UserSupport;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Get extends ApiAction
{
    private Account|null $account = null;

    private User|null $user = null;

    private UserSettings|null $settings = null;

    private Collection $workspaces;

    public function execute(User $user): bool
    {
        if (!UserSupport::existsAccount($user)) {
            abort(403, 'Forbidden');
        }

        $user->load('profile');

        $this->user = $user;

        $this->account = UserSupport::getAccount($user);

        $this->settings = UserSupport::getAccountSettings($user);

        $this->workspaces = UserSupport::getWorkspaces($user);

        return true;
    }

    protected function resource(): ResourceCollection|array|null
    {
        return [
            'account' => new AccountResource($this->account),
            'profile' => new UserResource($this->user),
            'settings' => new UserSettingsResource($this->settings),
            'workspaces' => WorkspaceResource::collection($this->workspaces)
        ];
    }
}
