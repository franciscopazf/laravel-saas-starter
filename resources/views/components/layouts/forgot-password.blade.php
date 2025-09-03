@php
    $pageVersion = (string) view('components.config.version', ['page' => 'login']);
@endphp

@include("components.pages.$pageVersion.forgot-password")
