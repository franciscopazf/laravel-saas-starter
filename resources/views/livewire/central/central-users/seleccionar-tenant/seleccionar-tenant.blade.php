<div class="p-6 max-w-md mx-auto">
    <h2 class="text-gray-800 dark:text-gray-100 text-lg font-semibold mb-6 text-center">
        Selecciona un Tenant
    </h2>

    <form class="grid gap-4" wire:submit="redirectToTenant">
        @foreach ($tenants as $tenant)
            <div class="relative group">
                <!-- Input oculto -->
                <input type="radio" id="tenant_{{ $tenant->id }}" name="tenant" class="peer hidden"
                    value="{{ $tenant->id }}" wire:model="tenantSeleccionado" />

                <!-- Card -->
                <label for="tenant_{{ $tenant->id }}"
                    class="block cursor-pointer rounded-xl border border-gray-300 dark:border-gray-700 p-4 bg-gray-50 dark:bg-zinc-800 text-gray-800 dark:text-gray-100 shadow-sm
                           transition-all duration-300 ease-in-out hover:shadow-md hover:border-purple-400 dark:hover:border-purple-500
                           peer-checked:border-purple-500 peer-checked:bg-purple-50 dark:peer-checked:bg-purple-900/20">
                    <div class="flex justify-between items-center">
                        <h3 class="font-semibold text-base">{{ $tenant->name }}</h3>

                        <!-- Check Icon -->
                        <span
                            class="w-6 h-6 rounded-full bg-purple-600 flex items-center justify-center opacity-0 scale-75 transition
                                     peer-checked:opacity-100 peer-checked:scale-100">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-7.364 7.364a1 1 0 01-1.414 0L3.293 9.414a1 1 0 011.414-1.414L8.5 11.793l6.793-6.793a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                    </div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">ID: {{ $tenant->id }}</p>
                </label>
            </div>
        @endforeach


        <!-- Botón -->
        <div class="mt-6 text-center">
            <button id="confirmTenant" type="submit"
                class="px-5 py-2.5 bg-purple-600 text-white font-semibold rounded-lg shadow-md hover:bg-purple-700
                   focus:outline-none focus:ring-2 focus:ring-purple-400 dark:focus:ring-purple-600 transition">
                Confirmar selección
            </button>
        </div>
    </form>
</div>
