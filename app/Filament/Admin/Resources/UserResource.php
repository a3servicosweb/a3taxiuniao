<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\RelationManagers;
use App\Filament\Admin\Resources\UserResource\RelationManagers\ComorbiditiesRelationManager;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Livewire\Component as LivewireComponent;
use Filament\Forms\Components\Livewire;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Pessoas';

    protected static ?string $pluralModelLabel = 'Pessoas';

    protected static ?string $modelLabel = 'Pessoa';

    protected static ?string $slug = 'pessoas';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Dados Gerais')
                            ->icon('heroicon-o-bars-4')
                            ->schema([
                                Split::make([
                                    Section::make([
                                        TextInput::make('cpf_number')
                                            ->autofocus()
                                            ->columnSpan(1)
                                            ->label('CPF')
                                            ->rule('cpf')
                                            ->maxLength(14)
                                            ->mask('999.999.999-99')
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->validationMessages([
                                                'unique' => 'O CPF já cadastrado.'
                                            ]),
                                        TextInput::make('name')
                                            ->label('Nome')
                                            ->columnSpan(4)
                                            ->required()
                                            ->maxLength(255),
                                        Select::make('blood_type')
                                            ->label('Tipo Sanguíneo')
                                            ->columnSpan(1)
                                            ->required()
                                            ->options([
                                                'A+' => 'A+',
                                                'A-' => 'A-',
                                                'B+' => 'B+',
                                                'B-' => 'B-',
                                                'AB+' => 'AB+',
                                                'AB-' => 'AB-',
                                                'O+' => 'O+',
                                                'O-' => 'O-',
                                            ]),
                                        TextInput::make('nickname')
                                            ->label('Apelido')
                                            ->columnSpan(3)
                                            ->maxLength(50),
                                        DatePicker::make('birth_date')
                                            ->label('Data de Nascimento')
                                            ->columnSpan(3),
                                        TextInput::make('nationality')
                                            ->label('Nacionalidade')
                                            ->columnSpan(3),
                                        TextInput::make('born_in')
                                            ->label('Naturalidade')
                                            ->columnSpan(3),
                                        Select::make('gender')
                                            ->label('Gênero')
                                            ->columnSpan(3)
                                            ->required()
                                            ->options([
                                                'Feminino' => 'Feminino',
                                                'Masculino' => 'Masculino',
                                                'Não Binário' => 'Não Binario',
                                                'Prefiro não informar' => 'Prefiro não informar',
                                            ]),
                                        Select::make('marital_status')
                                            ->label('Estado Civil')
                                            ->columnSpan(3)
                                            ->required()
                                            ->options([
                                                'Casado' => 'Casado',
                                                'Divorciado' => 'Divorciado',
                                                'Maritral' => 'Maritral',
                                                'Solteiro' => 'Solteiro',
                                                'Viúvo' => 'Viúvo',
                                            ]),
                                    ])->columns(6),
                                    Section::make([
                                        FileUpload::make('photo')
                                            ->label('Foto')
                                            ->directory('person_photo')
                                            ->disk('public'),
                                        Toggle::make('isActive')
                                            ->label('Status')
                                            ->required(),
                                    ])->grow(false),
                                ])->from('md'),
                            ]),
                        Tabs\Tab::make('Endereço')
                            ->icon('heroicon-o-home')
                            ->schema([
                                Fieldset::make('Endereço')
                                    ->relationship('address')
                                    ->schema([
                                        Forms\Components\TextInput::make('postal_code')
                                            ->label('CEP')
                                            ->mask('99999-999')
                                            ->required()
                                            ->suffixAction(fn($state, $set) => Action::make('search-action')
                                                ->icon('heroicon-o-magnifying-glass')
                                                ->action(function (LivewireComponent $livewire) use ($state, $set) {
                                                    $livewire->validateOnly('data.address.postal_code',
                                                        ['data.address.postal_code' => ['required', 'size:9']],
                                                        ['data.address.postal_code.size' => 'O campo CEP está incompleto'],
                                                    );

                                                    $set('number', null);
                                                    $set('complement', null);
                                                    $set('reference_point', null);

                                                    $cepData = Http::get("https://viacep.com.br/ws/{$state}/json/")
                                                        ->throw()
                                                        ->json();

                                                    if (in_array('erro', $cepData)) {
                                                        throw ValidationException::withMessages([
                                                            'data.address.postal_code' => 'CEP inválido',
                                                        ]);
                                                    }
                                                    $set('neighborhood', $cepData['bairro'] ?? null);
                                                    $set('address', $cepData['logradouro'] ?? null);
                                                    $set('city', $cepData['localidade'] ?? null);
                                                    $set('uf', $cepData['uf'] ?? null);
                                                })
                                            ),
                                        Forms\Components\TextInput::make('number')
                                            ->label('Número'),
                                        Forms\Components\TextInput::make('address')
                                            ->label('Endereço')->columnSpanFull(),
                                        Forms\Components\TextInput::make('complement')
                                            ->label('Complemento')->columnSpanFull(),
                                        Forms\Components\TextInput::make('neighborhood')
                                            ->label('Bairro'),
                                        Forms\Components\TextInput::make('city')
                                            ->label('Cidade'),
                                        Forms\Components\TextInput::make('uf')
                                            ->label('Estado'),
                                        Forms\Components\TextInput::make('reference_point')
                                            ->label('Ponto de Referência')->columnSpanFull(),
                                    ]),
                            ]),
                        Tabs\Tab::make('Dados Bancários')
                            ->icon('heroicon-o-home')
                            ->schema([
                                Fieldset::make('Dados Bancários')
                                    ->relationship('bankAccount')
                                    ->schema([
                                        TextInput::make('bank_name')
                                            ->label('Banco')
                                            ->columnSpan(6),
                                        TextInput::make('agency_number')
                                            ->label('Agência')
                                            ->columnSpan(2),
                                        TextInput::make('account_number')
                                            ->label('Conta')
                                            ->columnSpan(2),
                                        Select::make('account_type')
                                            ->label('Tipo de Conta')
                                            ->columnSpan(2)
                                            ->options([
                                                'Corrente' => 'Corrente',
                                                'Poupança' => 'Poupança',
                                            ]),
                                        TextInput::make('pix')
                                            ->label('Chave PIX')
                                            ->columnSpan(6),
                                    ])->columns(6),
                            ]),
                        Tabs\Tab::make('Documentos')
                            ->icon('heroicon-o-document')
                            ->schema([
                                Fieldset::make('Identidade')
                                    ->relationship('identity')
                                    ->schema([
                                        TextInput::make('identity_number')
                                            ->label('Número da Identidade')
                                            ->columnSpan(2)
                                            ->unique(ignoreRecord: true)
                                            ->validationMessages([
                                                'unique' => 'Identidade já cadastrada.'
                                            ]),
                                        TextInput::make('issuing_authority')
                                            ->label('Órgão Expedidor')
                                            ->columnSpan(2),
                                        DatePicker::make('issue_date')
                                            ->label('Data de Emissão')
                                            ->columnSpan(2),
                                        DatePicker::make('expiration_date')
                                            ->label('Data de Validade')
                                            ->columnSpan(2),
                                    ])->columns(8),
                                Fieldset::make('Título de Eleitor')
                                    ->relationship('electoral')
                                    ->schema([
                                        TextInput::make('voter_registration_number')
                                            ->label('Número do Título')
                                            ->columnSpan(2)
                                            ->unique(ignoreRecord: true)
                                            ->validationMessages([
                                                'unique' => 'Título já cadastrado.'
                                            ]),
                                        TextInput::make('voting_zone')
                                            ->label('Zona Eleitoral')
                                            ->columnSpan(2),
                                        TextInput::make('voting_section')
                                            ->label('Seção Eleitoral')
                                            ->columnSpan(2),
                                    ])->columns(6),
                                Fieldset::make('Carteira de Reservista')
                                    ->relationship('militaryReserveCard')
                                    ->schema([
                                        TextInput::make('reserve_card_number')
                                            ->label('Número da Carteira de Reservista')
                                            ->columnSpan(2)
                                            ->unique(ignoreRecord: true)
                                            ->validationMessages([
                                                'unique' => 'Carteira de Reservista já cadastrada.'
                                            ]),
                                        TextInput::make('series_number')
                                            ->label('Número de Série')
                                            ->columnSpan(2),
                                        DatePicker::make('issue_date')
                                            ->label('Data de Emissão')
                                            ->columnSpan(2),
                                    ])->columns(6),
                                Fieldset::make('Habilitação')
                                    ->relationship('driverLicense')
                                    ->schema([
                                        TextInput::make('license_number')
                                            ->label('Número da CNH')
                                            ->columnSpan(2)
                                            ->unique(ignoreRecord: true)
                                            ->validationMessages([
                                                'unique' => 'CNH já cadastrada.'
                                            ]),
                                        TextInput::make('license_category')
                                            ->label('Categoria')
                                            ->columnSpan(2),
                                        DatePicker::make('issue_date')
                                            ->label('Data de Emissão')
                                            ->columnSpan(2),
                                        DatePicker::make('expiration_date')
                                            ->label('Data de Validade')
                                            ->columnSpan(2),
                                        DatePicker::make('first_license_date')
                                            ->label('Data da 1ª Habilitação')
                                            ->columnSpan(2),
                                    ])->columns(6),
                                Fieldset::make('Nº de Benefício do INSS')
                                    ->relationship('socialSecurityNumber')
                                    ->schema([
                                        TextInput::make('pis_pasep')
                                            ->label('PIS/PASEP')
                                            ->columnSpan(2)
                                            ->unique(ignoreRecord: true)
                                            ->validationMessages([
                                                'unique' => 'PIS/PASEP já cadastrado.'
                                            ]),
                                        TextInput::make('nit')
                                            ->label('NIT')
                                            ->columnSpan(2)
                                            ->unique(ignoreRecord: true)
                                            ->validationMessages([
                                                'unique' => 'NIT já cadastrado.'
                                            ]),
                                        TextInput::make('nis')
                                            ->label('NIS')
                                            ->columnSpan(2)
                                            ->unique(ignoreRecord: true)
                                            ->validationMessages([
                                                'unique' => 'NIS já cadastrado.'
                                            ]),
                                    ])->columns(6),
                            ]),
                        Tabs\Tab::make('Comorbidades')
                            ->visibleOn('edit')
                            ->icon('heroicon-o-heart')
                            ->schema([
                                Livewire::make(ComorbiditiesRelationManager::class, fn(User $record, Pages\EditUser $livewire): array => [
                                    'ownerRecord' => $record,
                                    'pageClass' => $livewire::class,
                                ]),
                            ]),
                        Tabs\Tab::make('Vacinas')
                            ->visibleOn('edit')
                            ->icon('heroicon-o-beaker')
                            ->schema([
                                Livewire::make(RelationManagers\VaccinesRelationManager::class, fn(User $record, Pages\EditUser $livewire): array => [
                                    'ownerRecord' => $record,
                                    'pageClass' => $livewire::class,
                                ]),
                            ]),
                        Tabs\Tab::make('Acesso')
                            ->icon('heroicon-o-lock-closed')
                            ->schema([
                                Fieldset::make('Acesso')
                                    ->schema([
                                        TextInput::make('email')
                                            ->columnSpanFull()
                                            ->email()
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->validationMessages([
                                                'unique' => 'O Email já cadastrado.'
                                            ])
                                            ->maxLength(255),
                                        TextInput::make('password')
                                            ->label('Senha')
                                            ->password()
                                            ->maxLength(20)
                                            ->confirmed()
                                            ->required(fn(string $operation): bool => $operation === 'create')
                                            ->dehydrated(fn(?string $state) => filled($state)),
                                        TextInput::make('password_confirmation')
                                            ->label('Confirme a Senha')
                                            ->password() // Torna o campo do tipo "password"
                                            ->maxLength(255)
                                            ->requiredWith('password')
                                            ->dehydrated(false), // Não envia o valor deste campo ao backend
                                    ]),
                            ]),
                    ]),

            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y')
                    ->sortable(),
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
//            ComorbiditiesRelationManager::class,
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
}
