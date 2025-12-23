<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Central Student And Client Management System' }}</title>
    @include('components.links')
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @include('components.topstrip')
        @include('components.sidebar')

        <div class="body-wrapper">
            @include('components.topbar')
            <div class="body-wrapper-inner">
                <div class="contaier-fluid">
                    {{ $slot }}
                </div>


            </div>


        </div>



    </div>
    @include('components.scripts')

</body>

</html>
