<?php

namespace App\Jobs;

use App\Models\Identity;
use App\Models\User;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Carbon;

class UserCheckIdentityValidity implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Obter a data de 30 dias a partir de hoje
        $dateThreshold = Carbon::now()->addDays(30);
        $admin = User::where('id', 1)->first();

        // Buscar identidades com RGs prestes a expirar
        $identities = Identity::where('expiration_date', '<=', $dateThreshold)
            ->where('expiration_date', '>=', Carbon::now()) // Apenas documentos ainda válidos
            ->with('user') // Eager load do usuário associado
            ->get();
//        dd($identities);
        foreach ($identities as $identity) {
//            if ($identity->user) {
                // Enviar notificação para o banco de dados
                Notification::make()
                    ->title('Validade do RG está prestes a expirar')
                    ->body('O RG do usuário ' . $identity->user->name . ' está prestes a expirar.')
                    ->actions([
                        Action::make('Alterar')
                            ->button()
                            ->url(route('filament.admin.resources.pessoas.edit', [
                                'record' => $identity->user->id])),
                    ])

                    ->sendToDatabase($admin);
//            }
        }
    }
}
