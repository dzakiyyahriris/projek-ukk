<x-guest-layout>
    <div class="text-center mb-4">
        <h4 class="fw-800 text-white mb-1"
            style="font-family: 'Montserrat', sans-serif; letter-spacing: -1px; font-weight: 800;">
            Tiket Wisata
        </h4>
        <div class="bg-warning mx-auto rounded-pill" style="width: 40px; height: 4px; margin-bottom: 12px;"></div>
        <p class="text-white-50 small text-uppercase fw-bold" style="letter-spacing: 2px; font-size: 0.65rem;">
            Daftar Akun Baru
        </p>
    </div>

    <div class="card border-0 shadow-lg" style="border-radius: 20px; background: rgb(228, 220, 220);">
        <div class="card-body p-4 p-md-5">

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label small fw-bold text-muted text-uppercase"
                        style="font-size: 0.7rem;">Nama Lengkap</label>
                    <input id="name" type="text" name="name" class="form-control border-0 bg-light py-2 px-3"
                        style="border-radius: 10px; font-size: 0.9rem;" placeholder="Masukkan nama sampeyan"
                        value="{{ old('name') }}" required autofocus autocomplete="name">
                    <x-input-error :messages="$errors->get('name')" class="mt-1 small text-danger" />
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label small fw-bold text-muted text-uppercase"
                        style="font-size: 0.7rem;">Email Address</label>
                    <input id="email" type="email" name="email" class="form-control border-0 bg-light py-2 px-3"
                        style="border-radius: 10px; font-size: 0.9rem;" placeholder="nama@email.com"
                        value="{{ old('email') }}" required autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-1 small text-danger" />
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label small fw-bold text-muted text-uppercase"
                        style="font-size: 0.7rem;">Daftar Sebagai</label>
                    <select id="role" name="role" class="form-control border-0 bg-light py-2 px-3"
                        style="border-radius: 10px; font-size: 0.9rem; cursor: pointer;">
                        <option value="user">Pengunjung Wisata</option>
                        <option value="admin">Admin / Petugas</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label small fw-bold text-muted text-uppercase"
                        style="font-size: 0.7rem;">Password</label>
                    <input id="password" type="password" name="password"
                        class="form-control border-0 bg-light py-2 px-3" style="border-radius: 10px; font-size: 0.9rem;"
                        placeholder="••••••••" required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-1 small text-danger" />
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label small fw-bold text-muted text-uppercase"
                        style="font-size: 0.7rem;">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        class="form-control border-0 bg-light py-2 px-3" style="border-radius: 10px; font-size: 0.9rem;"
                        placeholder="••••••••" required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 small text-danger" />
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-dark fw-bold border-0 py-2"
                        style="border-radius: 10px; background: #0f172a; font-size: 0.85rem; letter-spacing: 0.5px; transition: 0.3s;">
                        DAFTAR SEKARANG
                    </button>
                </div>
            </form>

            <div class="text-center mt-4 pt-2">
                <p class="small text-muted mb-0" style="font-size: 0.8rem;">
                    Sudah punya akun?
                    <a href="{{ route('login') }}"
                        class="text-dark fw-bold text-decoration-none border-bottom border-dark ms-1">Masuk Sini</a>
                </p>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <p class="text-white-50" style="font-size: 9px; letter-spacing: 1px;">&copy; 2026 DISPAR SURABAYA</p>
    </div>
</x-guest-layout>
