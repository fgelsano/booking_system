<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <title>Shipping Booking</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico')}}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
   
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <style>
        .datePicker{
            top: 20%;
            right: 10%;
            width: 20%;
            display: flex;
            z-index: 9;
            background-color: rgba(255,255,255,0.9);
            padding: 2%;
            justify-content: center;
        }

        #datepicker{
            text-transform: uppercase;
            text-align: center;
        }

        #datepicker p{
            color: red;
        }

        .datePicker form #datepicker .datepicker{
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('assets/logo/rec/clr.png') }}" alt="logo" srcset="" width="15%">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="position-relative">
            @yield('content')
        </main>
    </div>
    <script>
        $(function() {
            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                startDate: new Date()
            }).on('changeDate', function(e) {
                $('#selectedDate').val(e.format('yyyy-mm-dd'));
            });
        });
        
        
        // get references to the datepicker and selectedDate input
        const datepicker = document.querySelector('#datepicker');
        const selectedDate = document.querySelector('#selectedDate');
        const datepickerText = document.querySelector('#datepicker-text');

        // set the initial datepicker text to the selected date
        datepickerText.innerText = new Date(selectedDate.value).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });

        // listen for changes to the selectedDate input
        selectedDate.addEventListener('change', () => {
            // get the selected date
            const date = new Date(selectedDate.value);

            // format the date string (e.g. "Mar 17, 2023")
            const dateString = date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });

            // update the datepicker text
            datepickerText.innerText = dateString;
        });

        const firstSelect = document.getElementById('origin');
        const secondSelect = document.getElementById('destination');

        firstSelect.addEventListener('change', (event) => {
        const selectedValue = event.target.value;

        // loop through all options in the second select element
        for (const option of secondSelect.options) {
            // disable options that are not the default option and whose value matches the selected value in the first select element
            if (option.value === selectedValue && option.value !== '0') {
            option.disabled = true;
            secondSelect.value = '0';
            } else {
            option.disabled = false;
            }
        }
        });
    </script>
</body>
</html>
