<x-layouts.app>
    <x-pages.flux.components.table.table :paginate="$visitantes">
        <x-pages.flux.components.table.columns>
            <x-pages.flux.components.table.column>
                Foto
            </x-pages.flux.components.table.column>
            <x-pages.flux.components.table.column>
                Nombre Completo
            </x-pages.flux.components.table.column>
            <x-pages.flux.components.table.column>
                Identidad
            </x-pages.flux.components.table.column>
            <x-pages.flux.components.table.column>
                Organización
            </x-pages.flux.components.table.column>
            <x-pages.flux.components.table.column>
                Puesto
            </x-pages.flux.components.table.column>
            <x-pages.flux.components.table.column>
                Teléfono
            </x-pages.flux.components.table.column>
            <x-pages.flux.components.table.column>
                Correo Electrónico
            </x-pages.flux.components.table.column>
            <x-pages.flux.components.table.column>
                Acciones
            </x-pages.flux.components.table.column>
        </x-pages.flux.components.table.columns>

        @foreach ($visitantes as $visitante)
            <x-pages.flux.components.table.row>
                <x-pages.flux.components.table.cell>
                    {{ $visitante->foto_url }}
                </x-pages.flux.components.table.cell>
                <x-pages.flux.components.table.cell>
                    {{ $visitante->nombre }}
                    {{ $visitante->apellido }}
                </x-pages.flux.components.table.cell>
                <x-pages.flux.components.table.cell>
                    {{ $visitante->numero_identidad }}
                </x-pages.flux.components.table.cell>
                <x-pages.flux.components.table.cell>
                    {{ $visitante->organizacion }}
                </x-pages.flux.components.table.cell>
                <x-pages.flux.components.table.cell>
                    {{ $visitante->puesto }}
                </x-pages.flux.components.table.cell>
                <x-pages.flux.components.table.cell>
                    {{ $visitante->telefono }}
                </x-pages.flux.components.table.cell>
                <x-pages.flux.components.table.cell>
                    {{ $visitante->email }}
                </x-pages.flux.components.table.cell>
                <x-pages.flux.components.table.cell>
                    @haspermission('eliminar-visitantes')
                        <form action="{{ route('delete_visitantes', ['visitante' => $visitante->id]) }}" method="POST"
                            class="inline">
                            <flux:button type="submit" icon="trash" variant="danger" square>
                                
                            </flux:button>
                            @csrf
                            @method('DELETE')
                        </form>
                    @endhaspermission
                    @haspermission('ver-visitantes')
                        <flux:button icon="eye" square variant="primary" color="blue"
                            href="{{ route('show_visitante', ['visitante' => $visitante->id]) }}" wire:navigate="replace">
                        
                        </flux:button>
                    @endhaspermission
                    @haspermission('acceder-edit-visitante')
                        <flux:button icon="pencil-square" variant="primary" color="amber" square
                            href="{{ route('edit_visitante', ['visitante' => $visitante->id]) }}" wire:navigate="replace">
                        
                        </flux:button>
                    @endhaspermission
                </x-pages.flux.components.table.cell>
            </x-pages.flux.components.table.row>
        @endforeach
    </x-pages.flux.components.table.table>
</x-layouts.app>
