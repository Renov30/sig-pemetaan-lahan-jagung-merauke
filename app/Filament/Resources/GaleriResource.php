<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GaleriResource\Pages;
use App\Filament\Resources\GaleriResource\RelationManagers;
use App\Models\Galeri;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GaleriResource extends Resource
{
    protected static ?string $model = Galeri::class;

    protected static bool $isLazy = false;

    protected static ?string $modelLabel = 'Galeri'; // Label untuk satu item
    protected static ?string $pluralModelLabel = 'Daftar Galeri'; // Label untuk daftar item
    protected static ?string $navigationLabel = 'Galeri'; // Label di sidebar

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Select::make('lahan_id')
                    ->label('Lahan')
                    ->required()
                    ->relationship('lahan', 'name', function ($query) {
                        // Filter lahan berdasarkan distrik user yang login (jika gapoktan)
                        if (auth()->check() && auth()->user()->hasRole('gapoktan')) {
                            $user = auth()->user();
                            if ($user->distrik_id) {
                                $query->where('distrik_id', $user->distrik_id);
                            } else {
                                // Jika gapoktan tidak punya distrik, tampilkan kosong
                                $query->whereRaw('1 = 0');
                            }
                        }
                    }),
                FileUpload::make('gambar')
                    ->label('Foto')
                    ->required()
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('lahan.name')
                    ->label('Lahan')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('gambar')
                    ->label('Foto'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
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
            'index' => Pages\ListGaleris::route('/'),
            'create' => Pages\CreateGaleri::route('/create'),
            'edit' => Pages\EditGaleri::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);

        // Filter untuk user gapoktan: hanya tampilkan galeri dari lahan di distrik mereka
        if (auth()->check() && auth()->user()->hasRole('gapoktan')) {
            $user = auth()->user();
            if ($user->distrik_id) {
                $query->whereHas('lahan', function ($q) use ($user) {
                    $q->where('distrik_id', $user->distrik_id);
                });
            } else {
                // Jika gapoktan tidak punya distrik, tampilkan kosong
                $query->whereRaw('1 = 0');
            }
        }

        return $query;
    }
}
