<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\VaccineResource\Pages;
use App\Filament\Admin\Resources\VaccineResource\RelationManagers;
use App\Models\Vaccine;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VaccineResource extends Resource
{
    protected static ?string $model = Vaccine::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?string $navigationLabel = 'Vacinas';

    protected static ?string $pluralModelLabel = 'Vacinas';

    protected static ?string $modelLabel = 'Vacina';

    protected static ?string $slug = 'vacinas';

    protected static ?string $navigationGroup = 'Tabelas Básicas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                    ->autofocus()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                    ->label('Descrição')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y')
            ])
            ->defaultSort('name')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListVaccines::route('/'),
            'create' => Pages\CreateVaccine::route('/create'),
            'edit' => Pages\EditVaccine::route('/{record}/edit'),
        ];
    }
}
