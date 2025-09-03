@php
    if (in_array(request()->getHost(), config('tenancy.central_domains'))) {
        $footerQuery = rk_navigation()
            ->newQuery()
            ->loadContexts(['footerDashboard'])
            ->filterForCurrentUser();

        $footerItems = $footerQuery->get();

        $configNode = $footerQuery->getSubBranch('central_settings_group')->first();

        $headerQuery = rk_navigation()
            ->newQuery()
            ->loadContexts(['headerDashboard'])
            ->filterForCurrentUser();

        $headerItems = $headerQuery->get();

        $fullQuery = rk_navigation()
            ->newQuery()
            ->loadContexts(['headerDashboard', 'footerDashboard'])
            ->filterForCurrentUser();

        $activeNode = $fullQuery->getActiveNodeParentWithChildren();
    } else {
        $footerQuery = rk_navigation()
            ->newQuery()
            ->loadContexts(['tenant_footerDashboard'])
            ->filterForCurrentUser();

        $footerItems = $footerQuery->get();

        $configNode = $footerQuery->getSubBranch('tenant_settings_group')->first();

        $headerQuery = rk_navigation()
            ->newQuery()
            ->loadContexts(['tenant_headerDashboard'])
            ->filterForCurrentUser();

        $headerItems = $headerQuery->get();

        $fullQuery = rk_navigation()
            ->newQuery()
            ->loadContexts(['tenant_headerDashboard', 'tenant_footerDashboard'])
            ->filterForCurrentUser();

        $activeNode = $fullQuery->getActiveNodeParentWithChildren();
    }
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>


    @include('components.pages.flux.partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">

    <!-- HEADER -->
    <flux:header sticky container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <!-- HEADER ITEMS -->
        <flux:navbar class="-mb-px " scrollable>
            @if (!is_null($activeNode))
                @foreach ($activeNode?->items as $item)
                    @if ($item->isGroup())
                        <flux:dropdown>
                            <flux:navbar.item icon:trailing="chevron-down">{{ $item->getLabel() }}</flux:navbar.item>
                            <flux:navmenu>
                                @foreach ($item->items as $child)
                                    <x-pages.flux.components.simple-node-nav-item :node="$child" />
                                @endforeach
                            </flux:navmenu>
                        </flux:dropdown>
                    @else
                        <x-pages.flux.components.simple-node-nav :node="$item" />
                    @endif
                @endforeach
            @endif
        </flux:navbar>

        <flux:spacer />

        <flux:navbar class="me-1.5 space-x-0.5 rtl:space-x-reverse py-0!">

            <!-- Aquí puedes agregar ítems extra como buscar o ayuda -->
        </flux:navbar>

        <!-- Desktop User Menu -->
        <flux:dropdown position="top" align="end">
            <flux:profile class="cursor-pointer" :initials="auth()->user()->initials()" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->firts_name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <x-pages.flux.components.simple-node :node="$configNode" />

                <flux:menu.radio.group>

                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    <!-- SIDEBAR -->
    <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-pages.flux.components.app-logo />
        </a>

        {{-- @if (auth()->user()->moreOneRole())
            <flux:dropdown position="bottom" align="end">
                <flux:profile name="Administrador" initials="Rol" icon:trailing="chevrons-up-down" />
                <flux:navmenu>
                    <flux:navmenu.item active href="#" icon="user">Administrador</flux:navmenu.item>
                    <flux:navmenu.item active href="#" icon="user">Abonado</flux:navmenu.item>
                </flux:navmenu>
            </flux:dropdown>
        @endif --}}

        <flux:navlist variant="outline">
            @foreach ($headerItems as $item)
                @if ($item->isGroup())
                    <flux:navlist.group :heading="$item->label" class="grid">
                        @foreach ($item->items as $child)
                            <x-pages.flux.components.simple-node :node="$child" />
                        @endforeach
                    </flux:navlist.group>
                @else
                    <x-pages.flux.components.simple-node :node="$item" />
                @endif
            @endforeach

        </flux:navlist>

        <flux:spacer />

        <flux:navlist variant="outline">

            @foreach ($footerItems as $item)
                <x-pages.flux.components.simple-node :node="$item" />
            @endforeach

        </flux:navlist>


        <!-- Desktop User Menu -->
        <flux:dropdown class="hidden lg:block" position="bottom" align="start">
            <flux:profile :email="auth()->user()->email" :name="auth()->user()->email"
                :initials="auth()->user()->initials()" icon:trailing="chevrons-up-down" />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>

                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">

                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>

                    <x-pages.flux.components.simple-node :node="$configNode" />
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <!-- MOBILE HEADER -->
    <flux:header class="hidden z-0" sticky>

    </flux:header>
    {{ $slot }}

    @livewire('notifications') {{-- Only required if you wish to send flash notifications --}}

    @filamentScripts
    @fluxScripts
</body>

</html>
