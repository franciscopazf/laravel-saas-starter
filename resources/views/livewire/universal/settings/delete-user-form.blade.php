@php
    $pageVersion = (string) view('components.config.version');
@endphp

@include("components.pages.$pageVersion.livewire.settings.delete-user-form")