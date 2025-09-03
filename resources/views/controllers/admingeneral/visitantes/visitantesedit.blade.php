<x-layouts.app>
    <section class="w-full">
        <x-pages.flux.components.settings.layout>
            <form action="{{ route('update_visitantes', ['visitante' => $visitante->id ?? null]) }}" method="POST"
                enctype="multipart/form-data" class="my-6 w-full space-y-6">
                @csrf

                <flux:input type="file" name="foto" label="Foto" class="{{ $errors->has('foto') ? 'invalid' : '' }}"
                    value="{{ $visitante->url_foto ?? '' }}" />
                @error('foto')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <flux:input :label="__('Nombre')" name="nombre" type="text" required autofocus
                    autocomplete="given-name" class="{{ $errors->has('nombre') ? 'invalid' : '' }}"
                    value="{{ $visitante->nombre ?? '' }}" />
                @error('nombre')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <flux:input :label="__('Apellido')" name="apellido" type="text" required autocomplete="family-name"
                    class="{{ $errors->has('apellido') ? 'invalid' : '' }}" value="{{ $visitante->apellido ?? '' }}" />
                @error('apellido')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <flux:input :label="__('Numero Identidad')" name="numero_identidad" type="text" required
                    autocomplete="off" class="{{ $errors->has('numero_identidad') ? 'invalid' : '' }}"
                    value="{{ $visitante->numero_identidad ?? '' }}" />
                @error('numero_identidad')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <flux:input :label="__('Organizacion')" name="organizacion" type="text" required
                    autocomplete="organization" class="{{ $errors->has('organizacion') ? 'invalid' : '' }}"
                    value="{{ $visitante->organizacion ?? '' }}" />
                @error('organizacion')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <flux:input :label="__('Puesto')" name="puesto" type="text" required
                    autocomplete="organization-title" class="{{ $errors->has('puesto') ? 'invalid' : '' }}"
                    value="{{ $visitante->puesto ?? '' }}" />
                @error('puesto')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <flux:input :label="__('Telefono')" name="telefono" type="text" required autocomplete="tel"
                    class="{{ $errors->has('telefono') ? 'invalid' : '' }}"
                    value="{{ $visitante->telefono ?? '' }}" />
                @error('telefono')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <flux:input :label="__('Correo')" name="email" type="text" required autocomplete="email"
                    class="{{ $errors->has('email') ? 'invalid' : '' }}" value="{{ $visitante->email ?? '' }}" />
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-end">
                        <flux:button variant="primary" type="submit" class="w-full">
                            {{ __('Guardar') }}
                        </flux:button>
                    </div>
                </div>
            </form>
        </x-pages.flux.components.settings.layout>
    </section>
</x-layouts.app>
