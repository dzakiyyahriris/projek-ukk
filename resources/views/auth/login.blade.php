<x-guest-layout>
    <div class="text-center mb-4">
        <h4 class="fw-800 text-white mb-1" style="font-family: 'Montserrat', sans-serif; letter-spacing: -1px; font-weight: 800;">
            Tiket Wisata
        </h4>
        <div class="bg-warning mx-auto rounded-pill" style="width: 40px; height: 4px; margin-bottom: 12px;"></div>
        <p class="text-white-50 small text-uppercase fw-bold" style="letter-spacing: 2px; font-size: 0.65rem;">
            Explore Surabaya Today
        </p>
    </div>

    <div class="card border-0 shadow-lg" style="border-radius: 20px; background: rgb(230, 223, 223);">
        <div class="card-body p-4 p-md-5">
            
            <x-auth-session-status class="mb-3 small alert alert-success" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label small fw-bold text-muted text-uppercase" style="font-size: 0.7rem;">Email Address</label>
                    <input type="email" id="email" name="email" 
                           class="form-control border-0 bg-light py-2 px-3" 
                           style="border-radius: 10px; font-size: 0.9rem;"
                           placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                    <x-input-error :messages="$errors->get('email')" class="mt-1 small text-danger" style="font-size: 0.75rem;" />
                </div>

                <div class="mb-3">
                    <input type="password" id="password" name="password" 
                           class="form-control border-0 bg-light py-2 px-3" 
                           style="border-radius: 10px; font-size: 0.9rem;"
                           placeholder="••••••••" required>
                    <x-input-error :messages="$errors->get('password')" class="mt-1 small text-danger" style="font-size: 0.75rem;" />
                </div>

                <div class="mb-4">
                    <div class="form-check">
                        <input class="form-check-input shadow-none" type="checkbox" name="remember" id="remember" style="cursor: pointer;">
                        <label class="form-check-label small text-muted" for="remember" style="cursor: pointer; font-size: 0.8rem;">
                            Remember me
                        </label>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-dark fw-bold border-0 py-2" 
                            style="border-radius: 10px; background: #0f172a; font-size: 0.85rem; letter-spacing: 0.5px; transition: 0.3s;">
                        MASUK SEKARANG
                    </button>
                </div>
            </form>

            <div class="text-center mt-4 pt-2">
                <p class="small text-muted mb-0" style="font-size: 0.8rem;">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-dark fw-bold text-decoration-none border-bottom border-dark ms-1">Daftar</a>
                </p>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <p class="text-white-50" style="font-size: 9px; letter-spacing: 1px;">&copy; 2026 DISPAR SURABAYA</p>
    </div>
</x-guest-layout>