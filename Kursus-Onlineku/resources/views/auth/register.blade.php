<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ __('auth.register_title') }} — Learnify</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <style>
        .lang-fab {
            position: fixed;
            right: 18px;
            bottom: 18px;
            z-index: 9999;
        }
        .lang-fab .dropdown-menu {
            min-width: 160px;
            padding: 8px;
        }
        .lang-pill {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 12px;
            text-decoration: none;
        }
        .lang-pill:hover {
            background: rgba(0,0,0,.04);
        }
        .lang-badge {
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 999px;
            background: rgba(78,115,223,.12);
            color: #4e73df;
            font-weight: 700;
        }
        .rocket-btn {
            width: 54px;
            height: 54px;
            border-radius: 999px;
            box-shadow: 0 10px 24px rgba(0,0,0,.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .rocket-btn i { font-size: 18px; }
    </style>
</head>

<body class="bg-gradient-primary">

    {{-- ROCKET BUTTON: LANGUAGE SWITCH --}}
    <div class="dropdown lang-fab">
    <button
        class="btn btn-light rocket-btn dropdown-toggle"
        type="button"
        id="langFab"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
        title="{{ __('ui.language') }}"
    >
        <img
            src="{{ app()->getLocale() === 'id'
                    ? asset('img/logo-bendera.png')
                    : asset('img/logo-bendera.png') }}"
            alt="Lang"
            class="lang-icon"
        >
    </button>

    <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="langFab">
        <div class="px-3 pt-2 pb-1 small text-muted">
            {{ __('ui.language') }}
        </div>

        <a class="lang-pill dropdown-item" href="{{ route('lang.switch', ['locale' => 'id']) }}">
            <img src="{{ asset('img/indo.png') }}" class="lang-flag" alt="ID">
            <span class="ml-2">ID</span>
            @if(app()->getLocale() === 'id')
                <span class="lang-badge ml-auto">{{ __('ui.active') }}</span>
            @endif
        </a>

        <a class="lang-pill dropdown-item" href="{{ route('lang.switch', ['locale' => 'en']) }}">
            <img src="{{ asset('img/inggris.png') }}" class="lang-flag" alt="EN">
            <span class="ml-2">EN</span>
            @if(app()->getLocale() === 'en')
                <span class="lang-badge ml-auto">{{ __('ui.active') }}</span>
            @endif
        </a>
    </div>
</div>


    <div class="container">
        <div class="row justify-content-center" style="height: 100vh">
            <div class="col-xl-4 col-lg-6 col-md-8 align-self-center mb-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="p-5">

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">{{ __('auth.register_heading') }}</h1>
                                    </div>

                                    <form class="user" action="{{ route('register') }}" method="POST">
                                        @csrf

                                        {{-- USER ID --}}
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control form-control-user @error('user_id') is-invalid @enderror"
                                                placeholder="{{ __('auth.user_id') }}"
                                                name="user_id"
                                                value="{{ old('user_id') }}"
                                                autofocus>
                                            @error('user_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- NAMA --}}
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control form-control-user @error('nama') is-invalid @enderror"
                                                placeholder="{{ __('auth.full_name') }}"
                                                name="nama"
                                                value="{{ old('nama') }}">
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- ALAMAT (opsional) --}}
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control form-control-user @error('alamat') is-invalid @enderror"
                                                placeholder="{{ __('auth.address_optional') }}"
                                                name="alamat"
                                                value="{{ old('alamat') }}">
                                            @error('alamat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- KOTA (opsional) --}}
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control form-control-user @error('kota') is-invalid @enderror"
                                                placeholder="{{ __('auth.city_optional') }}"
                                                name="kota"
                                                value="{{ old('kota') }}">
                                            @error('kota')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- PASSWORD --}}
                                        <div class="form-group">
                                            <input type="password"
                                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                                placeholder="{{ __('auth.password') }}"
                                                name="password">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- KONFIRM PASSWORD --}}
                                        <div class="form-group">
                                            <input type="password"
                                                class="form-control form-control-user"
                                                placeholder="{{ __('auth.password_confirm') }}"
                                                name="password_confirmation">
                                        </div>

                                        <button class="btn btn-primary btn-user btn-block" type="submit">
                                            {{ __('auth.register_button') }}
                                        </button>
                                    </form>

                                    <div class="text-center mt-3">
                                        <a href="{{ route('login') }}">{{ __('auth.have_account') }}</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>
</html>
