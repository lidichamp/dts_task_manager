<!DOCTYPE html>
<html lang="en" class="govuk-template">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'DTS Task Manager')</title>
    <link rel="shortcut icon" href="/logo.jpg" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="govuk-template__body">
     @include('partials.header')
    <div class="govuk-width-container">
       

        <main class="govuk-main-wrapper">
            @include('partials.flash_and_validation')
            @yield('content')
        </main>

       
    </div>
     @include('partials.footer')
</body>
</html>
