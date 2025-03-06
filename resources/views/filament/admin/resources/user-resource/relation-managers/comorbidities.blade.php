@if($this->record && $this->record->exists)
    @livewire(\App\Filament\Admin\Resources\UserResource\RelationManagers\ComorbiditiesRelationManager::class, [
    'ownerRecord' => $this->record,
    'pageClass' => get_class($this),
    ])
@else
    <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg">
        <p class="text-gray-700">Você poderá adicionar comorbidades após salvar o usuário.</p>
    </div>
@endif

{{--@livewire(\App\Filament\Admin\Resources\UserResource\RelationManagers\ComorbiditiesRelationManager::class, [--}}
{{--    'ownerRecord' => $this->record,--}}
{{--    'pageClass' => get_class($this),--}}
{{--])--}}

