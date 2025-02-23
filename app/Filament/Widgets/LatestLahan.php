<?php

namespace App\Filament\Widgets;

use App\Models\Lahan;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestLahan extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';

    protected static bool $isLazy = false;
    protected static ?string $heading = 'Data Lahan Terbaru';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Lahan::query()
                    ->latest()
                    ->limit(5) // Ini sudah cukup, tanpa get()
            )
            ->paginated(5)
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama Pemilik'),
                Tables\Columns\TextColumn::make('hasil_produksi')->label('Hasil Produksi'),
                Tables\Columns\TextColumn::make('luas_lahan')->label('Luas Lahan (ha)'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y'),
            ]);
    }
}
