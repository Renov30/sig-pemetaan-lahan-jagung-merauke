<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\Role;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Pastikan roles dimuat dengan benar
        $user = $this->record;
        if ($user && $user->roles) {
            $data['roles'] = $user->roles->first()?->id;
        }
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Hash password jika diubah
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            // Jika password kosong, hapus dari data agar tidak diupdate
            unset($data['password']);
        }

        // Jika role bukan gapoktan, set distrik_id menjadi null
        $gapoktanRole = Role::where('name', 'gapoktan')->first();
        $gapoktanRoleId = $gapoktanRole ? $gapoktanRole->id : null;
        
        $roleId = $data['roles'] ?? null;
        
        if ($gapoktanRoleId && $roleId != $gapoktanRoleId) {
            $data['distrik_id'] = null;
        }

        return $data;
    }
}
