<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProduksiResource\Pages;
use App\Filament\Resources\ProduksiResource\RelationManagers;
use App\Models\Produksi;
use Filament\Actions\Exports\Models\Export;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ProduksiResource extends Resource
{
    protected static ?string $model = Produksi::class;

    protected static bool $isLazy = false;

    protected static ?string $modelLabel = 'Produksi'; // Label untuk satu item
    protected static ?string $pluralModelLabel = 'Daftar Hasil Produksi'; // Label untuk daftar item
    protected static ?string $navigationLabel = 'Produksi'; // Label di sidebar

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //->schema([
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
                    })
                    ->preload(),
                DatePicker::make('tanggal_produksi')
                    ->label('Tanggal Produksi')
                    ->displayFormat('d M Y')
                    ->native(false)
                    ->required(),
                TextInput::make('hasil_produksi')
                    ->label('Jumlah Produksi')
                    ->suffix('ton')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('lahan.name')
                    ->label('Nama Lahan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tanggal_produksi')
                    ->label('Tanggal Produksi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('hasil_produksi')
                    ->label('Hasil Produksi')
                    ->searchable()
                    ->sortable(),
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
                        ->label('Ekspor Data'),
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
            'index' => Pages\ListProduksis::route('/'),
            'create' => Pages\CreateProduksi::route('/create'),
            'edit' => Pages\EditProduksi::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);

        // Filter untuk user gapoktan: hanya tampilkan produksi dari lahan di distrik mereka
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
