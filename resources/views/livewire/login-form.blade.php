<div class="mt-5">
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="d-flex justify-content-center shadow">

        <div class="col-6 bg-white p-5">
            <div class="fs-3">Sign In</div>
            <div class="mt-4">
                <form wire:submit.prevent="login">
                    <div class="mb-4">
                        <label class="text-uppercase mb-2">email address</label>
                        <div>
                            <input type="text"
                                   class="rounded-5 {{ $errors->has('email') ? 'form-error' : 'form-input' }}"
                                   wire:model="email"
                                   value="{{ old('email') }}"
                                   placeholder="Email Address">
                            @error('email')
                            <span class="fs-6 ms-2 mt-1 text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="text-uppercase mb-2">password</label>
                        <div>
                            <input type="text" class="rounded-5 {{ $errors->has('password') ? 'form-error' : 'form-input' }}" wire:model="password"
                                   placeholder="Password">
                            @error('password')
                            <span class="fs-6 ms-2 mt-1 text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <button class="log-button" type="submit">Sign In</button>
                    </div>
                    <div class="remember-me-n-forgot-pass">
                        <div>
                            <input wire:model="remember" id="remember" type="checkbox">
                            <label class="ms-2 remember-me" for="remember">Remember Me</label>
                        </div>
                        <div>Forgot Password?</div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-6 log-form-right">
            <div class="text-center">
                <div class="fs-2">Welcome Back User!</div>
                <div class="">Enter your email and password to log to our application.</div>
            </div>


        </div>
    </div>


</div>

@push('styles')
    <style>
        body{
            background: linear-gradient(#ccccff, #e5e5ff);
        }
        .log-form-right {
            background: #6666ff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .log-form-right div {
            color: #e5e5ff;
        }

        .form-error {
            width: 100%;
            padding: 1rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            border: 1px solid red;
            border-radius: 0.25rem;
        }

        .form-error:focus {
            outline: 0;
        }

        .form-input {
            display: block;
            width: 100%;
            padding: 1rem 1rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #f2f2f2;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;


        }

        .form-input:focus {
            color: #495057;
            background-color: #e5e5e5;
            outline: 0;
        }

        .form-input::placeholder {
            color: #6c757d;
            opacity: 1;
        }

        .log-button {

            padding: 1rem;
            width: 100%;
            border-radius: 5rem;
            background: #6666ff;
            border: none;
            color: #e5e5ff;
        }

        .remember-me-n-forgot-pass {
            display: flex;
            justify-content: space-between;
        }

        .remember-me {
            color: #7f7fff;
            cursor: pointer;
        }
    </style>
@endpush
