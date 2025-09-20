<?php

namespace App\Supports;

use App\Models\Account\Account;
use App\Models\Account\AccountModule;
use App\Models\Module\Module;

class ModuleSupport
{
    /**
     * @param string $moduleCode
     * @param int $accountId
     * @return bool|null
     */
    static public function installed(string $moduleCode, int $accountId): ?bool
    {
        return AccountModule::whereHas('module', fn($query) => $query->where('code', $moduleCode))
            ->where('account_id', $accountId)
            ->exists();
    }

    /**
     * @param Account $account
     * @return void
     */
    static public function installAll(Account $account): void
    {
        $values = [];
        foreach (Module::all() as $module) {
            $values[] = [
                'module_id' => $module->id,
                'account_id' => $account->id,
            ];
        }

        AccountModule::upsert($values, [
            'module_id',
            'account_id'
        ]);
    }

    /**
     * @param Account $account
     * @param string $moduleCode
     * @return void
     */
    static public function install(Account $account, string $moduleCode): void
    {
        $module = Module::findByCode($moduleCode);

        if ($module) {
            AccountModule::upsert([
                'module_id' => $module->id,
                'account_id' => $account->id,
            ], [
                'module_id',
                'account_id'
            ]);
        }
    }
}
