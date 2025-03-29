<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MandatoryDocumentResource\Pages;
use App\Filament\Admin\Resources\MandatoryDocumentResource\RelationManagers;
use App\Models\MandatoryDocument;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MandatoryDocumentResource extends Resource
{
    protected static ?string $model = MandatoryDocument::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Documentos Obrigatórios';

    protected static ?string $pluralModelLabel = 'Documentos Obrigatórios';

    protected static ?string $modelLabel = 'Documento Obrigatório';

    protected static ?string $slug = 'documentos-obrigatorios';

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
                    ->label('Descrição')
                    ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_mandatory')
                    ->label('É obrigatório?')
                    ->required(),
                Forms\Components\Toggle::make('requires_file')
                    ->label('Requer upload de arquivo?')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_mandatory')
                    ->boolean(),
                Tables\Columns\IconColumn::make('requires_file')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListMandatoryDocuments::route('/'),
            'create' => Pages\CreateMandatoryDocument::route('/create'),
            'edit' => Pages\EditMandatoryDocument::route('/{record}/edit'),
        ];
    }
}
