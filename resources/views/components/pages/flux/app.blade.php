@php

    if (in_array(request()->getHost(), config('tenancy.central_domains'))) {
        $query = rk_navigation()
            ->newQuery()
            ->loadContexts(['headerDashboard', 'footerDashboard'])
            ->filterForCurrentUser();

        $activo = $query->get();
        $breadcrumbs = $query->getBreadcrumbsForCurrentRoute();
        $activeNode = $query->getCurrentActiveNode();
    } else {
        $query = rk_navigation()
            ->newQuery()
            ->loadContexts(['tenant_headerDashboard', 'tenant_footerDashboard'])
            ->filterForCurrentUser();

        $activo = $query->get();
        $breadcrumbs = $query->getBreadcrumbsForCurrentRoute();
        $activeNode = $query->getCurrentActiveNode();
    }

@endphp

<x-pages.flux.layouts.app.header :title="$title ?? null">
    <flux:main>

        <flux:breadcrumbs class="mb-4">
            @if ($breadcrumbs->isNotEmpty() && $breadcrumbs->count() > 1)
                @foreach ($breadcrumbs as $breadcrumb)
                    <flux:breadcrumbs.item href="{{ $breadcrumb->getUrl() }}" separator="slash">
                        {{ $breadcrumb->getLabel() }}
                    </flux:breadcrumbs.item>
                @endforeach
            @endif
        </flux:breadcrumbs>


        <flux:heading size="xl">
            {{ $activeNode?->getLabel() ?? '' }}
        </flux:heading>
        <flux:subheading>
            {{ $activeNode?->getDescription() ?? '' }}
        </flux:subheading>
        <flux:separator variant="subtle" class="mt-2 mb-4" />
        {{ $slot }}
    </flux:main>
</x-pages.flux.layouts.app.header>
