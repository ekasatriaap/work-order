<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials.meta')
    <title>{{ $title }}</title>

    <link rel="shortcut icon" href="{{ asset('/assets/img/stisla.svg/') }}">
    @include('layouts.partials.styles')
    @stack('add-styles')

</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            {{-- navbar start --}}
            @include('layouts.partials.navbar')
            {{-- navbar end --}}

            {{-- sidebar start --}}
            @include('layouts.partials.sidebar')
            {{-- sidebar end --}}

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>{{ $title }}</h1>
                    </div>
                    {{-- main content start --}}
                    {{ $slot }}
                    {{-- main content end --}}
                </section>
                <x-modal title="Drsk modal" id="default-drsk-modal" />
            </div>

            {{-- footer start --}}
            @include('layouts.partials.footer')
            {{-- footer end --}}
        </div>
    </div>

    {{-- script start --}}
    <script>
        const DATATABLE_ID = `{{ DATATABLE_ID }}`;
        let DRSKMODAL;
    </script>
    @include('layouts.partials.scripts')
    <script>
        $(document).ready(function() {
            @if (session()->has('sweet_success'))
                alertSweet(`{{ session('sweet_success') }}`, 'success');
            @endif
            @if (session()->has('sweet_warning'))
                alertSweet(`{{ session('sweet_warning') }}`, 'warning');
            @endif
            @if (session()->has('sweet_info'))
                alertSweet(`{{ session('sweet_info') }}`, 'info');
            @endif
            @if (session()->has('sweet_error'))
                alertSweet(`{{ session('sweet_error') }}`, 'error');
            @endif
        });
    </script>
    @stack('add-scripts')
    {{-- script end --}}
</body>

</html>
