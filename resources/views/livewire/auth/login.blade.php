<section class="h-100-vh">
    <div class="page-header align-items-start section-height-50 pt-5 pb-11 m-3 border-radius-lg"
        style="background-image: url('../assets/img/curved-images/power-grid.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-5">{{ __('Welcome back!') }}</h1>
                    <p class="text-lead text-white">
                        {{ __('Enter your email and password to sign in.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                <div class="card z-index-0">
                    <div class="card-header text-center pt-6">
                        {{-- The logo is placed here --}}
                        <a href="/">
                            <img src="{{ asset('assets/img/logos/tnb_betterbrighter.png') }}" alt="Tenaga Nasional Berhad Logo" style="max-width: 200px; height: auto;">
                        </a>
                    </div>
                    <div class="card-body mt-2">
                        <form wire:submit="login" action="#" method="POST" role="form text-left">
                            <div class="mb-3">
                                <div class="@error('email') border border-danger rounded-3 @enderror">
                                    <input wire:model.live="email" type="email" class="form-control" placeholder="Email"
                                        aria-label="Email" aria-describedby="email-addon">
                                </div>
                                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <div class="@error('password') border border-danger rounded-3 @enderror">
                                    <input wire:model.live="password" type="password" class="form-control"
                                        placeholder="Password" aria-label="Password"
                                        aria-describedby="password-addon">
                                </div>
                                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-check form-switch">
                                <input wire:model.live="remember_me" class="form-check-input" type="checkbox"
                                    id="rememberMe">
                                <label class="form-check-label" for="rememberMe">{{ __('Remember me') }}</label>
                            </div>                            
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign in</button>
                            </div>
                            <div class="text-center">
                                <small class="text-muted">{{ __('Forgot your password?') }}
                                    <a href="{{ route('forgot-password') }}"
                                        class="text-info text-gradient font-weight-bold">{{ __('Reset it here') }} </a>
                                </small>
                            </div>                            
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
