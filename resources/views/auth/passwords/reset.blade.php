@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-body">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="text-center mb-4">
                <h1 class="h3 mb-3 font-weight-normal text-3d">{{ __('Reset Password') }}</h1>
            </div>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <label for="email" class="font-weight-bold">{{ __('Email') }} <i class="fa fa-envelope-o" aria-hidden="true"></i></label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password" class="font-weight-bold">{{ __('Password') }} <i class="fa fa-lock" aria-hidden="true"></i></label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirm" class="font-weight-bold">{{ __('Konfirmasi Password') }} <i class="fa fa-check-square-o" aria-hidden="true"></i></label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    <span id="password-confirm-error" class="invalid-feedback" role="alert"></span>
                </div><br>
                <div class="form-group">
                    <div class="col-md-6 offset-md-0">
                     <button type="submit" class="btn btn-primary"><i class="fa fa-undo"></i>
                            {{ __('Reset Password') }}
                        </button>
                        <a href="{{ url('/') }}" class="btn btn-danger ml-2"><i class="fa fa-arrow-circle-left"></i>
                            {{ __('Back to menu') }}
                        </a>
                    </div>
                </div>

            </form>
            <script>
                const passwordInput = document.getElementById('password');
                const passwordConfirmInput = document.getElementById('password-confirm');
                const passwordConfirmError = document.getElementById('password-confirm-error');

                passwordConfirmInput.addEventListener('input', function() {
                  if (passwordInput.value !== passwordConfirmInput.value) {
                    passwordConfirmInput.classList.add('is-invalid');
                    passwordConfirmError.textContent = '';
                  } else {
                    passwordConfirmInput.classList.remove('is-invalid');
                    passwordConfirmInput.classList.add('is-valid');
                    passwordConfirmError.innerHTML = '<i class="fa fa-check" aria-hidden="true"></i>';
                  }
                });

              </script>


        </div>
        <div></div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/password-confirm.js') }}"></script>
@endpush
