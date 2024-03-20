<?php

namespace App\Observers;

use App\Actions\TenantConnection;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        DB::statement('CREATE DATABASE ' . $user->database());
        
        info("dabatase criada através do observer");
        app(TenantConnection::class, ['user' => $user])->execute();
        Artisan::call('migrate --path=database/migrations/tenant --database=tenant');
        info(Artisan::output());
        info("migration concluida através do observer");
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
