<!DOCTYPE html>
<html >
    <head>

        <title>@yield('title', 'Thibitisha')</title>

    </head>
    <body>
       @include('test.partials.header')
       </h1> Karibu sana! </h1>
       
        <div id ="main content">
            @yield('content')
        </div>
        @include('test.partials.footer')
       </body>
</html>    
 
