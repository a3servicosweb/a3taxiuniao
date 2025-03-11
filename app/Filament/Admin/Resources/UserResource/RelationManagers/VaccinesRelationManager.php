<?php

namespace App\Filament\Admin\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VaccinesRelationManager extends RelationManager
{
    protected static string $relationship = 'vaccines';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('vaccine_id')
                    ->relationship('vaccine', 'name') // Relacionamento com Vaccine
                    ->required()
                    ->label('Vacina'),
                Forms\Components\TextInput::make('dose')
                    ->label('Dose')
                    ->placeholder('Ex.: Primeira Dose, Segunda Dose'),
                Forms\Components\DatePicker::make('vaccination_date')
                    ->label('Data da Vacinação')
                    ->required(),
                Forms\Components\DatePicker::make('next_dose_due')
                    ->label('Próxima Dose')
                    ->nullable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome da Vacina'),
                Tables\Columns\TextColumn::make('pivot.dose')
                    ->label('Dose'),
                Tables\Columns\TextColumn::make('pivot.vaccination_date')
                    ->label('Data da Vacinação')
                    ->date('d/m/Y'),
                Tables\Columns\TextColumn::make('pivot.next_dose_due')
                    ->label('Próxima Dose')
                    ->date('d/m/Y')
                    ->placeholder('Não definida'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->form(fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Forms\Components\TextInput::make('dose')
                            ->label('Dose')
                            ->placeholder('Ex.: Primeira Dose, Segunda Dose'),
                        Forms\Components\DatePicker::make('vaccination_date')
                            ->label('Data da Vacinação')
                            ->required(),
                        Forms\Components\DatePicker::make('next_dose_due')
                            ->label('Próxima Dose')
                            ->nullable(),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->form([
                        Forms\Components\TextInput::make('dose')
                            ->label('Dose')
                            ->placeholder('Ex.: Primeira Dose, Segunda Dose'),
                        Forms\Components\DatePicker::make('vaccination_date')
                            ->label('Data da Vacinação')
                            ->required(),
                        Forms\Components\DatePicker::make('next_dose_due')
                            ->label('Próxima Dose')
                            ->nullable(),
                    ]),
                Tables\Actions\DetachAction::make(),
                //Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
