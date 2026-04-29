<?php

namespace App\Filament\Resources;

use App\Exports\DistrikExport;
use App\Filament\Resources\DistrikResource\Pages;
use App\Filament\Resources\DistrikResource\RelationManagers;
use App\Models\Distrik;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;

class DistrikResource extends Resource
{
    protected static ?string $model = Distrik::class;

    protected static bool $isLazy = false;

    protected static ?string $modelLabel = 'Distrik'; // Label untuk satu item
    protected static ?string $pluralModelLabel = 'Daftar Distrik'; // Label untuk daftar item
    protected static ?string $navigationLabel = 'Distrik'; // Label di sidebar

    protected static ?string $navigationIcon = 'heroicon-o-map';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')
                    ->label('Nama Distrik')
                    ->required()
                    ->maxLength(255),
                TextInput::make('luas_tanam')
                    ->label('Luas Tanam')
                    ->required()
                    ->maxLength(255)
                    ->suffix('hektar'),
                TextInput::make('luas_panen')
                    ->label('Luas Panen')
                    ->required()
                    ->maxLength(255)
                    ->suffix('hektar'),
                TextInput::make('produksi')
                    ->label('Produksi')
                    ->required()
                    ->maxLength(255)
                    ->suffix('ton'),
                TextInput::make('produktivitas')
                    ->label('Produktivitas')
                    ->required()
                    ->maxLength(255)
                    ->suffix('ton/hektar'),
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
                TextColumn::make('luas_tanam')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('luas_panen')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('produksi')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('produktivitas')
                    ->sortable()
                    ->searchable(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->label('Ekspor')
                    ->color('gray')
                    ->button()
                    ->outlined()
                    ->exports([
                        DistrikExport::make()->fromTable(),
                    ]),
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
                    ExportBulkAction::make()
                        ->label('Ekspor Data')
                        ->exports([
                            DistrikExport::make()->fromTable(),
                        ]),
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
            'index' => Pages\ListDistriks::route('/'),
            'create' => Pages\CreateDistrik::route('/create'),
            'edit' => Pages\EditDistrik::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
