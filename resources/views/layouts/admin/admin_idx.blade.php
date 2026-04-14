<!DOCTYPE html>
<html>

<head>
    <title>@yield('title', 'My App')</title>
    @include('components.head')
</head>

<body>
    <top>
        @include('components.navbar')
    </top>
    <div class="container">
        <main>
            @yield('content')
        </main>
    </div>
</body>