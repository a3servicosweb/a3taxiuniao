<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserComorbidityResource\Pages;
use App\Filament\Admin\Resources\UserComorbidityResource\RelationManagers;
use App\Models\Comorbidity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComorbidityResource extends Resource
{
    protected static ?string $model = Comorbidity::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static ?string $navigationLabel = 'Comorbidades';

    protected static ?string $pluralModelLabel = 'Comorbidades';

    protected static ?string $modelLabel = 'Comorbidade';

    protected static ?string $slug = 'comorbidades';

    protected static ?string $navigationGroup = 'Tabelas Básicas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(100),
                Forms\Components\Textarea::make('description')
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
            'index' => Pages\ListComorbidities::route('/'),
            'create' => Pages\CreateComorbidity::route('/create'),
            'edit' => Pages\EditComorbidity::route('/{record}/edit'),
        ];
    }
}
