<div class="mt-5">
    <div class="col-5 mx-auto border border-secondary-subtle p-4 rounded">
        <form wire:submit.prevent="login">
            <div class="fs-5 fw-bold mb-3">Login to your account..</div>
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="mb-4">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" wire:model="email" placeholder="Enter your email..." class="form-control"
                       id="exampleInputEmail1" aria-describedby="emailHelp">
                @error('email')
                <span class="fs-6 ms-2 mt-1 text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" wire:model="password" placeholder="Enter your password..." class="form-control"
                       id="exampleInputPassword1">
                @error('password')
                <span class="fs-6 ms-2 mt-1 text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3 form-check">
                <input wire:model="remember" type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Remember Me</label>
            </div>

            <button type="submit" class="btn bg-black text-white form-control p-3">Log in</button>
        </form>
    </div>

</div>
