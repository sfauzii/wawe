@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <main>

        <div id="terms-popup" class="terms-popup">
            <!-- <button class="close-button-popup"
                        onclick="document.getElementById('terms-popup').style.display='none';">
                        &times;
                    </button> -->
            <div class="card terms-card">
                <div class="terms-content">
                    <h2>Terms and Conditions</h2>
                    <p class="fw-normal mb-3 text-center">Last Updated at 30 August 2023</p>
                    <p class="subtitle-primary mb-lg-5">Pelajari dengan baik agar proses transaksi di WaWe Tour and Travel lebih mudah dan nyaman</p>
                    <p>Syarat dan Ketentuan ini merupakan perjanjian antara pengguna dan PT Patra Transportasi
                        Nusantara
                        (“Kami”). Syarat dan
                        Ketentuan ini mengatur Anda saat mengakses dan menggunakan seluruh layanan, fitur dan produk
                        yang kami sediakan (untuk
                        selanjutnya secara bersama-sama akan disebut sebagai “Platform”).

                        Harap membaca Syarat dan Ketentuan ini secara seksama sebelum Anda mulai menggunakan
                        Platform
                        Kami, karena peraturan ini
                        berlaku pada penggunaan Anda terhadap Platform Kami.

                        Anda mengerti dan setuju bahwa Syarat dan Ketentuan ini merupakan perjanjian dalam bentuk
                        elektronik dan tindakan Anda
                        menekan tombol ‘daftar’ saat pembukaan Akun atau tombol ‘masuk’ saat akan mengakses Akun
                        Anda
                        merupakan persetujuan
                        aktif Anda untuk mengikatkan diri dalam perjanjian dengan Kami sehingga keberlakuan Syarat
                        dan
                        Ketentuan ini dan
                        Kebijakan Privasi adalah sah dan mengikat secara hukum dan terus berlaku sepanjang
                        penggunaan
                        Platform oleh Anda. Bila
                        Anda tidak setuju dengan Syarat dan Ketentuan Penggunaan ini, maka Anda tidak diperkenankan
                        menggunakan Platform kami.

                        Kami dapat mengubah Syarat dan Ketentuan ini dari waktu ke waktu, perubahan akan
                        diberitahukan
                        kepada Anda melalui
                        email, melalui pemberitahuan yang diunggah di Platform, atau sebagaimana yang diwajibkan
                        oleh
                        hukum yang berlaku; dan
                        Anda setuju bahwa Anda bertanggung jawab untuk meninjau Syarat dan Ketentuan ini secara
                        berkala.
                        Penggunaan secara
                        berkelanjutan oleh Anda atas layanan yang diberikan dalam Platform setelah perubahan
                        dan/atau
                        penambahan Syarat dan
                        Ketentuan yang berlaku, akan dianggap sebagai persetujuan dan penerimaan Anda atas perubahan
                        dan/atau penambahan
                        tersebut. Anda dapat menyampaikan keberatan atas perubahan dan/atau penambahan atas Syarat
                        dan
                        Ketentuan yang berlaku
                        yang dianggap merugikan Anda secara komersial dan material dalam jangka waktu 14 (empat
                        belas)
                        hari kalender sejak
                        perubahan dan/atau penambahan tersebut dipublikasikan. Kami berhak untuk menghentikan akses
                        Anda
                        terhadap Platform dalam
                        hal Anda berkeberatan atas perubahan dan/atau penambahan Syarat dan Ketentuan yang berlaku
                        tersebut.</p>
                    <!-- Add more paragraphs as needed to make it scrollable -->

                    <div class="list-terms">
                        <div class="text-left-terms">
                            <h2>1. Akun</h2>
                            <p>Anda harus berusia minimal 18 (delapan belas) tahun atau sudah menikah dan tidak
                                berada
                                di
                                bawah perwalian atau
                                pengampuan agar Anda secara hukum memiliki kapasitas dan berhak untuk mengikatkan
                                diri
                                pada
                                Syarat dan Ketentuan ini.
                                Jika Anda tidak memenuhi ketentuan tersebut, maka tindakan Anda mendaftar,
                                mengakses,
                                menggunakan atau melakukan
                                aktivitas lain dalam Platform Kami harus dalam sepengetahuan, pengawasan dan
                                persetujuan
                                yang sah dari orang tua atau
                                wali atau pengampu Anda. Orang tua, wali atau pengampu yang memberikan persetujuan
                                bagi
                                Anda
                                yang berusia di bawah 18
                                (delapan belas) tahun bertanggung jawab secara penuh atas seluruh tindakan Anda
                                dalam
                                penggunaan dan akses terhadap
                                Platform.

                                Dengan mendaftar dan/atau menggunakan Platform Kami, maka Anda dan/atau orang tua,
                                wali
                                atau
                                pengampu Anda (jika Anda
                                berusia di bawah 18 tahun) dianggap telah membaca, mengerti, memahami dan menyetujui
                                semua
                                isi dalam Syarat dan
                                Ketentuan ini.

                                Sebelum menggunakan Platform, kami meminta Anda untuk menyetujui Syarat dan
                                Ketentuan
                                beserta Kebijakan Privasi untuk
                                Anda dapat mendaftarkan diri Anda dengan memberikan informasi yang Kami butuhkan.
                                Saat
                                melakukan pendaftaran, Kami akan
                                meminta Anda untuk memberikan nama lengkap, foto profil dan alamat surat elektronik
                                Anda.
                                Kami juga dapat menghentikan
                                penggunaan Platform jika dikemudian hari data-data yang Anda berikan kepada Kami
                                terbukti
                                tidak benar.

                                Keamanan dan kerahasiaan akun Anda, termasuk namun tidak terbatas pada seluruh data
                                pribadi
                                yang Anda berikan kepada
                                kami melalui formulir pendaftaran pada Platform kami, sepenuhnya merupakan tanggung
                                jawab
                                pribadi Anda. Segala kerugian
                                dan risiko yang timbul akibat atau sehubungan dengan kelalaian Anda dalam menjaga
                                keamanan
                                dan kerahasiaan akun Anda
                                ditanggung oleh Anda sendiri dan/atau orang tua, wali atau pengampu Anda (bagi
                                Pengguna
                                yang
                                berada di bawah Usia
                                Dewasa). Dengan demikian, kami akan menganggap setiap penggunaan atau pesanan yang
                                dilakukan
                                melalui akun Anda sebagai
                                permintaan yang sah dari Anda.</p>

                        </div>
                        <div class="text-left-terms">
                            <h2>2. Layanan dan Biaya</h2>
                            <p>Anda mengakui bahwa kelas tertentu dari Platform kami mungkin tidak tersedia untuk
                                Anda
                                kecuali Anda mengikuti kelas
                                premium yang tersedia pada Platform kami, yang sekarang dikenakan biaya sekali bayar
                                untuk akses kelas tertentu
                                selamanya. Anda setuju dan mengakui bahwa setiap ketentuan yang disampaikan kepada
                                Anda
                                pada saat proses menggunakan
                                pada Platform kami dianggap sebagai bagian dari Ketentuan Penggunaan ini.

                                Akses Anda terhadap kelas premium yang tersedia pada Platform kami hanya akan aktif
                                setelah Anda mengisi dan
                                menyampaikan seluruh data dan dokumen wajib yang diperlukan dan menyelesaikan
                                seluruh
                                pembayaran biaya kelas atau paket
                                secara tepat waktu. Anda setuju untuk membayar biaya kelas atau paket yang berlaku
                                tanpa
                                pengurangan atau pemotongan
                                pajak. Jika pengurangan atau pemotongan pajak adalah wajib, Anda akan bertanggung
                                jawab
                                untuk membayarkan jumlah
                                tambahan sebagaimana diperlukan agar kami menerima pembayaran penuh dari biaya kelas
                                yang berlaku. Anda memahami bahwa
                                PT Angga Membangun Indonesia dari waktu ke waktu dapat mengubah harga atau
                                memberikan
                                uji coba dan penawaran khusus yang
                                dapat mengakibatkan jumlah yang dikenakan kepada Pengguna tertentu menjadi berbeda.
                            </p>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Breadcrumbs -->
        <section class="section-details-header"></section>
        <section class="section-details-content">
            <div class="container">
                <div class="row">
                    <div class="col p-0">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    Paket Healing
                                </li>
                                <li class="breadcrumb-item">
                                    Details
                                </li>
                                <li class="breadcrumb-item active">
                                    Checkout
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <!-- Detail Content -->
                <div class="row">
                    <div class="col-lg-8 pl-lg-0">
                        <div class="card card-details">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h1>Who is going?</h1>
                            <p>
                                Trip to {{ $item->travel_package->title }}, {{ $item->travel_package->location }}
                            </p>
                            <div class="attendee">
                                <table class="table table-responsive-sm text-center">
                                    <thead>
                                        <tr>
                                            <td>Picture</td>
                                            <td>Name</td>
                                            <td>Phone</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($item->details as $detail)
                                            <tr>
                                                <td>
                                                    <img src="https://ui-avatars.com/api/?name={{ $detail->username }}"
                                                        height="60" class="rounded-circle" alt="">
                                                </td>
                                                <td class="align-middle">
                                                    {{ $detail->username }}
                                                </td>
                                                <td class="align-middle">
                                                    @if ($detail->phone)
                                                        {{ $detail->phone }} <!-- Nomor telepon dari TransactionDetail -->
                                                    @else
                                                        {{ $detail->transaction->user->phone }}
                                                        <!-- Jika tidak ada, tampilkan phone dari user yang login -->
                                                    @endif
                                                    <!-- Menampilkan nomor telepon pengguna -->
                                                </td>

                                                <td class="align-middle">
                                                    <a href="{{ route('checkout-remove', $detail->id) }}">
                                                        <img src="{{ url('frontend/images/ic_remove.png') }}"
                                                            alt="">
                                                    </a>
                                                </td>
                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    No Visitors
                                                </td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                            <div class="member mt-3">
                                <h2>Add Member</h2>
                                <form class="form-inline" method="post" action="{{ route('checkout-create', $item->id) }}">
                                    @csrf
                                    <label for="username" class="sr-only">Userame</label>
                                    <input type="text" name="username" value="{{ old('username') }}" required
                                        class="form-control mb-2 mr-sm-2" id="username" placeholder="Username">

                                    <label for="phone" class="sr-only">Phone</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}" required
                                        class="form-control mb-2 mr-sm-2" id="phone" placeholder="Phone">


                                    {{-- <label for="phone" class="sr-only">Phone</label>
                                    <input type="text" name="phone" value="{{ Auth::user()->phone ?? '' }}" required
                                        class="form-control mb-2 mr-sm-2" id="phone" placeholder="Phone">

                                    <!-- Form validation error message display -->
                                    @if ($errors->has('phone'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('phone') }}
                                        </div>
                                    @endif --}}

                                    {{-- <label for="nationality" class="sr-only">Nationality</label>
                                    <input type="text" name="nationality" style="width: 50px" required
                                        class="form-control mb-2 mr-sm-2" id="nationality" placeholder="Nationality">

                                    <label for="is_visa" class="sr-only">Visa</label>
                                    <select name="is_visa" id="is_visa" required class="custom-select mb-2 mr-sm-2">
                                        <option value="" selected>VISA</option>
                                        <option value="1">30 Days</option>
                                        <option value="0">N/A</option>
                                    </select>

                                    <label for="doe_passport" class="sr-only">DOE Passport</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <input type="text" class="form-control datepicker" name="doe_passport"
                                            id="doe_passport" placeholder="DOE Passport">
                                    </div> --}}

                                    {{--  --}}

                                    <button type="submit" class="btn btn-add-now mb-2 px-4">
                                        Add Now
                                    </button>
                                </form>
                                {{-- <h3 class="mt-2 mb-0">Note</h3>
                                <p class="disclaimer mb-0">You are only able invite member that has registered in Poling</p> --}}
                            </div>

                        </div>
                    </div>


                    <!-- Card Kanan -->
                    <div class="pl-2 col-lg-4 mt-0">
                        <div class="card card-details card-right">
                            @livewire('checkout-calculator', ['transactionId' => $item->id])

                            <div class="text-center mt-3">
                                <a href="{{ route('cancel-booking', $item->id) }}" class="text-muted">Cancel Booking</a>
                            </div>

                            {{-- <hr> --}}
                            {{-- <p style="font-size: 14px;"></p>
                            Presented By
                            </p>

                            <div class="bank">
                                <div class="bank-item pb-3">
                                    <img src="{{ url('frontend/svg/images/midtrans-logo.svg') }}" alt=""
                                        class="bank-image">
                                    <div class="description"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div> --}}

                        </div>
                        {{-- <div class="join-container">
                            <a href="{{ route('checkout-success', $item->id) }}"
                                class="btn btn-block btn-join-now mt-3 py-2">Process Payment</a>
                        </div> --}}

                    </div>
                </div>
            </div>

        </section>
    </main>

@endsection

{{-- @section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            event.preventDefault();
            var snapToken = "{{ session('snapToken') }}";
            if (snapToken) {
                snap.pay(snapToken, {
                    onSuccess: function(result) {
                        // console.log(result);
                        window.location.href = "{{ route('checkout-success', $item->id) }}";
                    },
                    onPending: function(result) {
                        // console.log(result);
                    },
                    onError: function(result) {
                        // console.log(result);
                    }
                });
            } else {
                console.log('Snap token tidak tersedia.');
            }
        };
    </script>

@endsection --}}
