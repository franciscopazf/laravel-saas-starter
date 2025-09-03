<?php

namespace App\Livewire\Universal\Settings;

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DeleteUserForm extends Component
{
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
       
        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}
