<?php

namespace App\Filament\Admin\Resources\UserResource\RelationManagers;

use App\Models\Comorbidity;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComorbiditiesRelationManager extends RelationManager
{
    protected static string $relationship = 'comorbidities';

    // Adicione este método para fazer o RelationManager aparecer na Tab
    public static function getTabLabel(): string
    {
        return 'Comorbidades';
    }

    protected function getTableFiltersFormWidth(): string
    {
        return '2xl';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('comorbidity_id')
                    ->label('Comorbidade')
                    ->relationship(name: 'comorbidities', titleAttribute: 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')

            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
//                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make()
                    ->label('Vincular Comorbidade')
                    ->modalHeading('Vincular Comorbidade')
                    ->modalWidth('2xl'),
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
//                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
