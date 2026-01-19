@extends('user.layouts.app')

@section('content')
    <div class="booking-confirmation-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8">

                    {{-- Main Ticket Card --}}
                    <div class="ticket-card animate-slide-up">

                        {{-- Header Section: Success --}}
                        <div class="ticket-header text-center p-4">
                            <div class="success-icon mb-3">
                                <i class="ti ti-circle-check-filled"></i>
                            </div>
                            <h4 class="fw-bold text-white mb-1">Pesanan Diterima!</h4>
                            <p class="text-white-50 small mb-0">Silakan selesaikan pembayaran di loket.</p>
                        </div>

                        {{-- Body Section: Order Code --}}
                        <div class="ticket-body p-4 bg-white position-relative">
                            <div class="notch notch-left"></div>
                            <div class="notch notch-right"></div>

                            <div class="text-center">
                                <span class="text-uppercase text-muted fw-bold small ls-2">Kode Booking Anda</span>

                                <div class="code-box mt-2 mb-3" onclick="copyText('{{ $pesanan->kode_pesanan }}')">
                                    <h1 class="display-5 fw-black text-primary mb-0 tracking-widest" id="orderCode">
                                        {{ $pesanan->kode_pesanan }}
                                    </h1>
                                    <span class="tap-hint"><i class="ti ti-copy me-1"></i> Ketuk untuk salin</span>
                                </div>

                                <div
                                    class="alert alert-warning border-0 d-inline-flex align-items-center py-2 px-3 rounded-pill mb-3">
                                    <i class="ti ti-ticket me-2 fs-5"></i>
                                    <span class="fw-bold small">BAYAR DI LOKET (CASH)</span>
                                </div>
                            </div>

                            <div class="ticket-divider my-4"></div>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted d-block mb-1">Total Tagihan</small>
                                    <h5 class="fw-bold text-dark">Rp
                                        {{ number_format($pesanan->jumlah_total, 0, ',', '.') }}</h5>
                                </div>
                                <div class="col-6 text-end">
                                    <small class="text-muted d-block mb-1">Tanggal Pesan</small>
                                    <h6 class="fw-bold text-dark">
                                        {{ \Carbon\Carbon::parse($pesanan->created_at)->format('d M Y') }}</h6>
                                </div>
                            </div>

                            <div class="bg-light rounded-3 p-3 mt-2">
                                <h6 class="fw-bold mb-3 small text-uppercase text-muted"><i
                                        class="ti ti-info-circle me-1"></i> Cara Pembayaran</h6>
                                <ul class="timeline-list list-unstyled mb-0">
                                    <li class="timeline-item">
                                        <span class="bullet">1</span>
                                        <p class="mb-0 small">Datang ke <strong>Loket Utama</strong>.</p>
                                    </li>
                                    <li class="timeline-item">
                                        <span class="bullet">2</span>
                                        <p class="mb-0 small">Tunjukkan <strong>Kode Booking</strong> di atas.</p>
                                    </li>
                                    <li class="timeline-item">
                                        <span class="bullet">3</span>
                                        <p class="mb-0 small">Lakukan pembayaran tunai & terima tiket fisik.</p>
                                    </li>
                                </ul>
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('user.dashboard') }}"
                                    class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm hover-scale">
                                    <i class="ti ti-arrow-left me-2"></i> Kembali ke Dashboard
                                </a>
                                <p class="text-center text-muted mt-3 mb-0" style="font-size: 0.75rem;">
                                    *Pesanan otomatis hangus jika tidak dibayar hari ini.
                                </p>
                            </div>
                        </div>

                        {{-- Decorative Bottom --}}
                        <div class="ticket-footer"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Custom CSS untuk Tampilan Tiket --}}
    <style>
        /* 1. Background Halaman */
        .booking-confirmation-section {
            background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
            /* Clean greyish */
            min-height: 85vh;
            display: flex;
            align-items: center;
        }

        /* 2. Kartu Tiket Utama */
        .ticket-card {
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        /* 3. Header Gradient */
        .ticket-header {
            background: linear-gradient(45deg, #4e73df, #224abe);
            color: white;
            padding-bottom: 2.5rem !important;
            /* Ruang untuk lekukan */
            position: relative;
        }

        .success-icon {
            font-size: 3.5rem;
            color: rgba(255, 255, 255, 0.9);
            animation: popIn 0.6s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        }

        /* 4. Body & Notches (Lekukan Tiket) */
        .ticket-body {
            position: relative;
            background: #fff;
            margin-top: -20px;
            /* Overlap ke atas */
            border-radius: 24px 24px 0 0;
            z-index: 10;
        }

        .notch {
            position: absolute;
            top: 215px;
            /* Sesuaikan posisi vertikal lekukan */
            width: 30px;
            height: 30px;
            background-color: #ebedee;
            /* Samakan dengan background body luar */
            border-radius: 50%;
            z-index: 20;
        }

        .notch-left {
            left: -15px;
        }

        .notch-right {
            right: -15px;
        }

        .ticket-divider {
            border-top: 2px dashed #e0e0e0;
            margin: 0 10px;
            position: relative;
        }

        /* 5. Code Box Styling */
        .code-box {
            background: #f8f9fc;
            border: 2px dashed #4e73df;
            border-radius: 12px;
            padding: 15px;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .code-box:hover {
            background: #eff4ff;
            border-color: #224abe;
            transform: scale(1.02);
        }

        .code-box:active {
            transform: scale(0.98);
        }

        .tap-hint {
            font-size: 0.75rem;
            color: #4e73df;
            opacity: 0;
            transition: opacity 0.2s;
            display: block;
            margin-top: 5px;
        }

        .code-box:hover .tap-hint {
            opacity: 1;
        }

        .tracking-widest {
            letter-spacing: 3px;
        }

        .fw-black {
            font-weight: 900;
        }

        .ls-2 {
            letter-spacing: 2px;
        }

        /* 6. Timeline Instructions */
        .timeline-list {
            padding-left: 10px;
        }

        .timeline-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 12px;
            position: relative;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .bullet {
            width: 24px;
            height: 24px;
            background: #eef2ff;
            color: #4e73df;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: bold;
            margin-right: 12px;
            flex-shrink: 0;
        }

        /* 7. Footer Zigzag (Opsional, pakai radius saja biar simple) */
        .ticket-footer {
            height: 10px;
            background: #fff;
            border-radius: 0 0 24px 24px;
        }

        /* Animations */
        .animate-slide-up {
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes popIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .hover-scale:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(78, 115, 223, 0.3) !important;
        }

        /* Print Adjustment */
        @media print {
            .booking-confirmation-section {
                background: white;
            }

            .btn,
            .tap-hint {
                display: none;
            }

            .ticket-card {
                box-shadow: none;
                border: 2px solid #000;
            }
        }
    </style>

    {{-- Script dengan SweetAlert2 (Jika ada) atau Alert Biasa yang dipercantik --}}
    <script>
        function copyText(text) {
            navigator.clipboard.writeText(text).then(() => {
                // Cek jika SweetAlert2 tersedia
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Disalin!',
                        text: 'Kode pesanan berhasil disalin.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    // Fallback custom toast atau alert biasa
                    const hint = document.querySelector('.tap-hint');
                    const originalText = hint.innerHTML;
                    hint.innerHTML = '<i class="ti ti-check"></i> Tersalin!';
                    hint.style.opacity = '1';
                    hint.classList.add('text-success');

                    setTimeout(() => {
                        hint.innerHTML = originalText;
                        hint.classList.remove('text-success');
                        hint.style.opacity = ''; // reset to CSS hover rule
                    }, 2000);
                }
            });
        }
    </script>
@endsection
