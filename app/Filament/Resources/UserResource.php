<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Distrik;
use App\Models\Role;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationGroup = 'Settings';

    protected static bool $isLazy = false;

    protected static ?string $modelLabel = 'User'; // Label untuk satu item
    protected static ?string $pluralModelLabel = 'Daftar User'; // Label untuk daftar item
    protected static ?string $navigationLabel = 'Users'; // Label di sidebar

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        // Ambil ID role gapoktan
        $gapoktanRole = Role::where('name', 'gapoktan')->first();
        $gapoktanRoleId = $gapoktanRole ? $gapoktanRole->id : null;

        return $form
            ->schema([
                //
                TextInput::make('name')
                    ->label('Nama User')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('password')
                    ->label('Password')
                    ->autocomplete('new-password')
                    ->required(fn($livewire) => $livewire instanceof \App\Filament\Resources\UserResource\Pages\CreateUser)
                    ->helperText(fn($livewire) => $livewire instanceof \App\Filament\Resources\UserResource\Pages\CreateUser ? 'Minimal 6 karakter' : 'Kosongkan jika tidak ingin mengubah password')
                    ->minLength(6)
                    ->maxLength(255)
                    ->password()
                    ->revealable()
                    ->dehydrated(fn($livewire, $state) => $livewire instanceof \App\Filament\Resources\UserResource\Pages\CreateUser || !empty($state)),
                TextInput::make('no_hp')
                    ->required()
                    ->label('No. Hp')
                    ->maxLength(255),
                TextInput::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),
                TextInput::make('tempat_lahir')
                    ->required()
                    ->label('Tempat Lahir')
                    ->maxLength(255),
                DatePicker::make('tgl_lahir')
                    ->label('Tanggal Lahir')
                    ->required()
                    ->displayFormat('d F Y')
                    ->native(false),
                TextInput::make('pekerjaan')
                    ->label('Pekerjaan')
                    ->required()
                    ->maxLength(255),
                Select::make('roles')
                    ->label('Role')
                    ->required()
                    ->relationship('roles', 'name')
                    ->multiple(false)
                    ->preload()
                    ->live(onBlur: false)
                    ->afterStateUpdated(function ($state, callable $set) use ($gapoktanRoleId) {
                        // Jika role bukan gapoktan, hapus distrik_id
                        if ($gapoktanRoleId && $state != $gapoktanRoleId) {
                            $set('distrik_id', null);
                        }
                    }),
                Select::make('distrik_id')
                    ->label('Distrik')
                    ->relationship('distrik', 'name')
                    ->searchable()
                    ->preload()
                    ->visible(function ($get) use ($gapoktanRoleId) {
                        if (!$gapoktanRoleId) {
                            return false;
                        }
                        $roleId = $get('roles');
                        // Handle jika roleId adalah array (multiple roles)
                        if (is_array($roleId)) {
                            return in_array($gapoktanRoleId, $roleId);
                        }
                        return $roleId == $gapoktanRoleId;
                    })
                    ->required(function ($get) use ($gapoktanRoleId) {
                        if (!$gapoktanRoleId) {
                            return false;
                        }
                        $roleId = $get('roles');
                        // Handle jika roleId adalah array (multiple roles)
                        if (is_array($roleId)) {
                            return in_array($gapoktanRoleId, $roleId);
                        }
                        return $roleId == $gapoktanRoleId;
                    })
                    ->helperText('Hanya untuk akun dengan role Gapoktan. Pilih distrik yang akan ditugaskan ke akun ini.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('no_hp')
                    ->label('No. Hp')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('tempat_lahir')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('tgl_lahir')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('pekerjaan')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->label('Role')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('distrik.name')
                    ->label('Distrik')
                    ->sortable()
                    ->searchable()
                    ->placeholder('Tidak ada distrik')
                    ->default('Tidak ada distrik'),
            ])
            ->filters([
                // Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
