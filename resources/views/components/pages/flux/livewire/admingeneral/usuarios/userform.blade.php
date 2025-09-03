<section class="w-full">
    <x-pages.flux.components.settings.layout>
        <form wire:submit="createOrUpdateUser()" class="my-6 w-full space-y-6">
            <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name" />

            <div>
                <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />
            </div>

            <flux:input
                wire:model="password"
                :label="__('Password')"
                type="password"
                required
                autocomplete="new-password"
            />
            <flux:input
                wire:model="password_confirmation"
                :label="__('Confirm Password')"
                type="password"
                required
                autocomplete="new-password"
            />

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Guardar') }}</flux:button>
                </div>

                <x-pages.flux.components.action-message class="me-3" on="user-created">
                {{ __('Usuario creado correctamente.') }}
                </x-pages.flux.components.action-message>
            </div>
        </form>

    </x-pages.flux.components.settings.layout>
</section>
