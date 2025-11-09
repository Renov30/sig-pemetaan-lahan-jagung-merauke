<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
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
        $roles = $data['roles'] ?? [];
        if (is_array($roles)) {
            $hasGapoktan = in_array('gapoktan', $roles);
        } else {
            $hasGapoktan = $roles === 'gapoktan';
        }

        if (!$hasGapoktan) {
            $data['distrik_id'] = null;
        }

        return $data;
    }
}
