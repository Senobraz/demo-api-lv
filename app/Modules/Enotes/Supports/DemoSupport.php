<?php

namespace App\Modules\Enotes\Supports;

use App\Models\Account\Account;
use App\Models\Module\Module;
use App\Models\User\UserAccount;
use App\Models\User\UserWorkspace;
use App\Models\Workspace\Workspace;
use App\Modules\Enotes\Models\Section;
use App\Modules\Enotes\Models\Note;
use Illuminate\Support\Facades\Date;

class DemoSupport
{
    static public function initializeDemoForWorkspace(string $fromAccountUlid, int $toWorkspaceId)
    {
        $module = Module::findByCode(Module::MODULE_ENOTE);

        $toOwnerId = UserWorkspace::where('workspace_id', $toWorkspaceId)->first()->user_id;

        $fromAccount = Account::where('ulid', $fromAccountUlid)->first();

        if(!$fromAccount) {
            return false;
        }

        $fromOwnerId = UserAccount::where('account_id', $fromAccount->id)->first()->id;

        $fromWorkspaceId = Workspace::where('owner_id', $fromOwnerId)
            ->where('module_id', $module->id)
            ->first()->id;

        if(!$fromWorkspaceId) {
            return false;
        }

        $fromSections = Section::where('workspace_id', $fromWorkspaceId)->get();

        foreach ($fromSections as $fromSection) {
            $newSection = $fromSection->replicate();

            $newSection->ulid = null;
            $newSection->workspace_id = $toWorkspaceId;
            $newSection->created_by = $toOwnerId;
            $newSection->updated_by = $toOwnerId;

            $newSection->save();

            $fromNotes = Note::where('section_id', $fromSection->getId())
                ->orderBy('sort', 'asc')
                ->get();

            foreach ($fromNotes as $fromNote) {
                $newNote = $fromNote->replicate([
                    'updated_content_at'
                ]);

                $newNote->ulid = null;
                $newNote->workspace_id = $toWorkspaceId;
                $newNote->section_id = $newSection->getId();
                $newNote->created_by = $toOwnerId;
                $newNote->updated_by = $toOwnerId;
                $newNote->updated_content_at = Date::now();

                $newNote->save();
            }
        }
    }
}
