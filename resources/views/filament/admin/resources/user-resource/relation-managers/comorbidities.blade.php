<div>
    @if($getRecord())
        @livewire(\App\Filament\Admin\Resources\UserResource\RelationManagers\ComorbiditiesRelationManager::class, [
            'ownerRecord' => $getRecord(),
            'pageClass' => \App\Filament\Admin\Resources\UserResource\Pages\EditUser::class
        ])
    @endif
</div>

