<div>
    <x-pages.flux.components.table.table :paginate="$this->users">
        <x-pages.flux.components.table.columns>
            <x-pages.flux.components.table.column>
                Nombre
            </x-pages.flux.components.table.column>
            <x-pages.flux.components.table.column>
                Correo Electrónico
            </x-pages.flux.components.table.column>
            <x-pages.flux.components.table.column>
                Acciones
            </x-pages.flux.components.table.column>
        </x-pages.flux.components.table.columns>

        @foreach ($this->users as $usuario)
            <x-pages.flux.components.table.row>
                <x-pages.flux.components.table.cell>
                    {{ $usuario->name }}
                </x-pages.flux.components.table.cell>
                <x-pages.flux.components.table.cell>
                    {{ $usuario->email }}
                </x-pages.flux.components.table.cell>
                <x-pages.flux.components.table.cell>
                    <flux:modal.trigger name="confirm-modal">
                        <flux:button icon="trash" variant="danger" wire:click="delete({{ $usuario->id }})">Delete
                        </flux:button>
                    </flux:modal.trigger>
                    <flux:button icon="pencil-square" variant="primary" color="amber"
                        href="{{ route('editarusuario_Jdp', $usuario->id) }}" wire:navigate class="ml-2"
                        >Editar</flux:button>
                </x-pages.flux.components.table.cell>
            </x-pages.flux.components.table.row>
        @endforeach
    </x-pages.flux.components.table.table>
</div>
