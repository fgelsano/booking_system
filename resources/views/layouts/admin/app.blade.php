@include('layouts.admin.partials._header')
<div class="wrapper">
    @include('layouts.admin.partials._preloader')
    @include('layouts.admin.partials._navbar')
    @include('layouts.admin.partials._sidebar')
 

    <div class="content-wrapper p-5">
        @yield('content')
    </div>
    
</div>
@include('layouts.admin.partials._footer')