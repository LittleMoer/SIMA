<!DOCTYPE html>
<html>

<head>
    <title>Ketersediaan unit</title>
</head>
<style>
    .available {
        background-color: green !important;
        color: white;
        /* teks warna putih agar lebih kontras */
    }

    .not-available {
        background-color: red !important;
        color: white;
        /* teks warna putih agar lebih kontras */
    }

    .seri-1 {
        background-color: #F5EFFF !important;
    }

    .seri-2 {
        background-color: #fffffe !important;
    }

    .seri-3 {
        background-color: #faefe8 !important;
    }

    .btn-purple {
        background-color: rgb(18, 16, 18);
        color: white;
    }

    .btn-orange {
        background-color: orange;
        color: white;
    }

    /* Mengubah warna tombol dengan class .btn-warning menjadi oranye */
.btn-warning {
    background-color: #FF5722; /* Oranye */
    border-color: #FF5722;
}

/* Mengubah warna tombol dengan class .btn-info menjadi ungu */
.btn-info {
    background-color: #9C27B0; /* Ungu */
    border-color: #9C27B0;
}

/* Mengubah warna tombol dengan class .btn-warning menjadi oranye */
.btn-warning {
    background-color: #f6f938 !important; /* Oranye */
    border-color: #f6f938!important;
    color: black !important;
}

/* Mengubah warna tombol dengan class .btn-info menjadi ungu */
.btn-info {
    background-color: #ec25b7 !important; /* Ungu */
    border-color: #ec25b7 !important;
    color: black !important;
}

.btn{
    color: black !important;
}

    /* .table-container {
    max-height: 1000px;
    overflow-y: auto;
    position: relative;
}

.table-container thead {
    position: sticky;
    top: 0;
    z-index: 2;
}

.table-container th {
    position: sticky;
    top: 0;
    background-color: white;
    z-index: 2;
    /* Tambahkan border agar lebih jelas */
    border-bottom: 2px solid #dee2e6;
    /* Optional: tambahkan shadow */
    box-shadow: 0 2px 4px rgba(0, 0, 0, .1);
    }

    /* Pastikan table memiliki width 100% */
    .table-container table {
        width: 100%;
        margin-bottom: 0;
    }

    */
</style>

<body>
    @section('unit_avail')
        <section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
            <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}" alt="Help center header">
            <h3 class="text-center"> Kalender Unit</h3>
            <h5 class="text-center px-3 mb-0">Jadwal ketersediaan unit perbulan</h5>
            @if (session('success'))
                @if (session('success'))
                    <div id="successToast" class="toast-container"
                        style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
                        <div class="toast align-items-center text-white bg-success border-0 show" role="alert"
                            aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    ✓ {{ session('success') }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                    <script>
                        setTimeout(() => {
                            const toastElement = document.getElementById('successToast');
                            if (toastElement) {
                                toastElement.remove();
                            }
                        }, 2500);
                    </script>
                @endif


                <!-- Script untuk menghilangkan toast setelah beberapa detik -->
                <script>
                    setTimeout(function() {
                        var toastElement = document.getElementById('successToast');
                        if (toastElement) {
                            toastElement.style.display = 'none'; // Menghilangkan toast
                        }
                    }, 2500);
                </script>
            @endif
        </section>

        <section>

            <div class="card">
                <div class="container" style="padding: 30px 30px">
                    <div class="d-flex align-items-center mb-4">
                        <a
                            href="{{ route('calendar.month', ['month' => $month == 1 ? 12 : $month - 1, 'year' => $month == 1 ? $year - 1 : $year]) }}">
                            <i class='bx bx-chevron-left' style="font-size: 1.5rem;"></i>
                        </a>

                        <h2 class="mx-2 mb-0">{{ \Carbon\Carbon::create($year, $month, 1)->format('F Y') }}</h2>

                        <a
                            href="{{ route('calendar.month', ['month' => $month == 12 ? 1 : $month + 1, 'year' => $month == 12 ? $year + 1 : $year]) }}">
                            <i class='bx bx-chevron-right' style="font-size: 1.5rem;"></i>
                        </a>
                    </div>


                    <div>
                        {{-- <a href="{{ route('calendar.month', ['month' => $month == 1 ? 12 : $month - 1, 'year' => $month == 1 ? $year - 1 : $year]) }}">
                            <i class='bx bx-chevron-left'></i> Previous Month
                        </a>
                        <a href="{{ route('calendar.month', ['month' => $month == 12 ? 1 : $month + 1, 'year' => $month == 12 ? $year + 1 : $year]) }}">
                            Next Month <i class='bx bx-chevron-right'></i>
                        </a>                         --}}
                    </div>
                    <div class="table-container">
                        <table class="table table-hover border-top table-fixed" border="1">
                            <thead class="bg-light shadow border" style="position: sticky; top: 0;  z-index: 100;">
                                <tr>
                                    <th>
                                        <h6>Tanggal</h6>
                                    </th>
                                    @foreach ($units as $unit)
                                        <th scope="col" class="{{ 'seri-' . $unit->seri_unit }} ">
                                            <h6>{{ $unit->nama_unit }}</h6>
                                        </th>
                                    @endforeach

                                </tr>
                            </thead>
                            <tbody>
                                @for ($day = 1; $day <= $daysInMonth; $day++)
                                    <?php $date = \Carbon\Carbon::create($year, $month, $day)->format('Y-m-d'); ?>
                                    <tr>
                                        {{-- <td>{{ \Carbon\Carbon::create($year, $month, $day)->format('d F Y') }}</td> --}}
                                        <td>
                                            <h4>{{ \Carbon\Carbon::create($year, $month, $day)->format('d') }} </h4>
                                        </td>
                                        {{-- @foreach ($units as $unit)
                                        <?php
                                        $isAvailable = isset($availability[$date]) && $availability[$date]->where('id_unit', $unit->id_unit)->first() && $availability[$date]->where('id_unit', $unit->id_unit)->first()->available;
                                        ?>
                                        <td class="{{ 'seri-' . $unit->seri_unit }}">
                                            <form class="availability-form" action="{{ route('availability.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="date" value="{{ $date }}">
                                                <input type="hidden" name="id_unit" value="{{ $unit->id_unit }}">
                                                <input type="hidden" name="available" value="{{ $isAvailable ? 0 : 1 }}">
                                                <button type="submit" class="btn {{ $isAvailable ? 'btn-danger' : 'btn-success' }} rounded-pill w-100  btn-sm box-shadow: none !important;">
                                                    {{ $isAvailable ? 'Terpakai' : 'Tersedia' }}
                                                </button>
                                                
                                            </form>
                                        </td>
                                    @endforeach --}}
                                        @foreach ($units as $unit)
                                            <?php
                                            $status = isset($availability[$date]) && $availability[$date]->where('id_unit', $unit->id_unit)->first() ? $availability[$date]->where('id_unit', $unit->id_unit)->first()->available : 0; // Default ke Tersedia
                                            $status = $status % 4; // Validasi rentang status
                                            
                                            $statusClasses = ['btn-secondary', 'btn-success', 'btn-warning', 'btn-info'];
                                            $statusLabels = ['Tersedia', 'Terpakai', 'Booking', 'Perpal'];
                                            ?>
                                            <td class="{{ 'seri-' . $unit->seri_unit }}">
                                                <form class="availability-form" action="{{ route('availability.update') }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="date" value="{{ $date }}">
                                                    <input type="hidden" name="id_unit" value="{{ $unit->id_unit }}">
                                                    <input type="hidden" name="available" value="{{ $status }}">
                                                    <button type="submit"
                                                        class="btn {{ $statusClasses[$status] }} rounded-pill w-100 btn-sm box-shadow: none !important;">
                                                        {{ $statusLabels[$status] }}
                                                    </button>
                                                </form>
                                            </td>
                                        @endforeach

                                    </tr>
                                @endfor

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </section>
        





    @endsection

    @include('main_owner')

</body>
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil semua form dengan class availability-form
        const forms = document.querySelectorAll('.availability-form');

        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Ambil data form
                const formData = new FormData(this);
                const button = this.querySelector('button');

                // Kirim AJAX request
                fetch('{{ route('availability.update') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update tampilan button
                            const isNowAvailable = formData.get('available') === '1';
                            button.className =
                                `btn ${isNowAvailable ? 'btn-danger':'btn-success' } rounded-pill w-100  btn-sm box-shadow: none !important;`;
                            button.textContent = isNowAvailable ? 'Terpakai' : 'Tersedia';

                            // Update hidden input untuk next update
                            this.querySelector('input[name="available"]').value =
                                isNowAvailable ? '0' : '1';

                            // Tampilkan toast
                            showToast('Ketersediaan Unit berhasil diperbarui');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showToast('Terjadi kesalahan', 'danger');
                    });
            });
        });

        // Fungsi untuk menampilkan toast
        function showToast(message, type = 'success') {
            const toast = `
                    <div id="successToast" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
                        <div class="bs-toast toast show bg-${type}" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <div class="me-auto fw-semibold">✓ Ketersediaan Unit</div>
                            </div>
                            <div class="toast-body">
                                ${message}
                            </div>
                        </div>
                    </div>
                `;

            // Hapus toast lama jika ada
            const oldToast = document.getElementById('successToast');
            if (oldToast) {
                oldToast.remove();
            }

            // Tambahkan toast baru
            document.body.insertAdjacentHTML('beforeend', toast);

            // Hilangkan toast setelah beberapa detik
            setTimeout(() => {
                const newToast = document.getElementById('successToast');
                if (newToast) {
                    newToast.remove();
                }
            }, 2500);
        }
    });
</script>
 --}}


{{-- // ini belum sama refresh --}}
{{-- <script>
    fetch('{{ route('availability.update') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const newStatus = data.new_status;
                const button = form.querySelector('button');

                // Update button class dan text berdasarkan status baru
                const statusClasses = ['btn-success', 'btn-danger', 'btn-warning', 'btn-info'];
                const statusLabels = ['Tersedia', 'Terpakai', 'Booking', 'Perpal'];

                button.className =
                    `btn ${statusClasses[newStatus]} rounded-pill w-100 btn-sm box-shadow: none !important;`;
                button.textContent = statusLabels[newStatus];

                // Update hidden input untuk status berikutnya
                form.querySelector('input[name="available"]').value = newStatus;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Terjadi kesalahan', 'danger');
        });
</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tangkap semua form dengan tombol untuk update availability
        const forms = document.querySelectorAll('.availability-form');


        forms.forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah pengiriman form secara default

                const formData = new FormData(this); // Ambil data form
                const button = form.querySelector('button'); // Tombol dalam form
                const hiddenInput = form.querySelector(
                    'input[name="available"]'); // Hidden input status

                fetch('{{ route('availability.update') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const newStatus = data.new_status; // Status baru dari server

                            // Update tombol (class dan teks) berdasarkan status baru
                            const statusClasses = ['btn-secondary', 'btn-success',
                                'btn-warning', 'btn-info'
                            ];
                            const statusLabels = ['Tersedia', 'Terpakai', 'Booking',
                                'Perpal'
                            ];

                            button.className =
                                `btn ${statusClasses[newStatus]} rounded-pill w-100 btn-sm`;
                            button.textContent = statusLabels[newStatus];

                            // Update hidden input ke status baru
                            hiddenInput.value = newStatus;

                            // Beri notifikasi ke pengguna
                            showToast('Ketersediaan berhasil diperbarui', 'success');
                        } else {
                            // Jika ada error dari server
                            showToast('Gagal memperbarui ketersediaan', 'danger');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showToast('Terjadi kesalahan saat memperbarui ketersediaan',
                            'danger');
                    });
            });
        });
    });

    // Fungsi untuk menampilkan toast
    function showToast(message, type = 'success') {
        const toast = `
                    <div id="successToast" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
                        <div class="bs-toast toast show bg-${type}" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <div class="me-auto fw-semibold">✓ Ketersediaan Unit</div>
                            </div>
                            <div class="toast-body">
                                ${message}
                            </div>
                        </div>
                    </div>
                `;

        // Hapus toast lama jika ada
        const oldToast = document.getElementById('successToast');
        if (oldToast) {
            oldToast.remove();
        }

        // Tambahkan toast baru
        document.body.insertAdjacentHTML('beforeend', toast);

        // Hilangkan toast setelah beberapa detik
        setTimeout(() => {
            const newToast = document.getElementById('successToast');
            if (newToast) {
                newToast.remove();
            }
        }, 2500);
    }
</script>

</html>
