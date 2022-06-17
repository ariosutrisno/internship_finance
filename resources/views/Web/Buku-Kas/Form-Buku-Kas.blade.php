@extends('Web.Layouts.app')
@section('title', 'Buat Buku Kas')
@section('container')
    @include('Web.Layouts.css&js.cssdashboard')
    @include('Web.Layouts.css&js.css')
    @include('Web.Layouts.css&js.csslog')
    <div class="sidenav">
        <div class="login-main-text">
            <div class="text-center">
                <img src="{{ asset('frontend/img/Group 439.png') }}" class="pb-4" alt="#">

                <h2>Lets Get You Set Up</h2>

                <p class="text-justify">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sapiente facere
                    tempora voluptatibus
                    laborum tenetur esse. Recusandae, est nobis. Nam et quod earum! Quae, quas? Facere sequi natus dicta
                    illo tempora!</p>

            </div>
        </div>
    </div>
    <div class="main">
        <div class="col-md-8 ml-auto mr-auto">
            <div class="login-form">

                <form id="create_buku" class="mb-5" style="padding:10px">
                    @csrf
                    <div class="form-group row">
                        <label for="buku" class="col-sm-4 col-form-label">Nama Buku Kas</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="buku" name="buku_nama"
                                value="{{ old('buku_nama') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="desc" class="col-sm-4 col-form-label">Deskripsi Buku Kas</label>
                        <div class="col-sm-8">
                            <textarea class="form-control " id="desc" name="buku_deskripsi" value="{{ old('buku_deskripsi') }}"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="currency" class="col-sm-4 col-form-label">Saldo Awal</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="currency1" onkeyup="changevalue()">
                            <input type="text" class="form-control" name="buku_saldo_awal" id="currency2"
                                value="{{ old('buku_saldo_awal') }}" hidden>
                            <input type="text" class="form-control" name="buku_saldo_akhir" id="currency3"
                                value="{{ old('buku_saldo_akhir') }}" hidden>

                        </div>
                    </div>
                    <center> <button type="button" class="text-center tombol btn">Continue</button>
                    </center>
                </form>
            </div>
        </div>
    </div>




    <script>
        var rupiah = document.getElementById('currency1');
        rupiah.addEventListener('keyup', function(e) {
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, ' ');
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? ' ' + rupiah : '');
        }

        function changevalue() {
            var rupiah = document.getElementById('currency1').value;
            var rupiahchange = rupiah.split(".").join("").split(" ").join("");
            document.getElementById('currency2').value = rupiahchange;
            document.getElementById('currency3').value = rupiahchange;

        }

        function buat() {

            var buku = document.getElementById("buku").value;
            var currency = document.getElementById("currency").value;


            if (buku == '' || currency == '') {
                Swal.fire({
                    title: '<strong>Buku Kas Kosong</u></strong>',
                    icon: 'error',
                    html: 'Masukan data dengan benar',
                    showConfirmButton: false,
                    focusConfirm: false,
                })
            } else {
                Swal.fire({
                    title: '<strong>Created succesfully</strong>',
                    icon: 'success',
                    html: 'Congratulation, Book created succesfully',

                    focusConfirm: false,
                    showConfirmButton: false,
                }).then(function() {
                    // Redirect the user
                    window.location.href = "dompet-pribadi";
                    console.log('The Ok Button was clicked.');
                })
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $(".tombol").click(function() {
                var book = document.getElementById("buku").value;
                var desc = document.getElementById("desc").value;
                var saldo = document.getElementById("currency1").value;
                let input_create = $('#create_buku').serialize()
                if (book == '') {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Nama buku Wajib Diisi !',
                        showConfirmButton: false,
                    });
                } else if (desc == '') {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Deskripsi Buku Wajib Diisi !',
                        showConfirmButton: false,
                    });
                } else if (saldo == '') {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Saldo Buku Wajib Diisi !',
                        showConfirmButton: false,
                    });
                } else {
                    $.ajax({
                        url: '{{ route('save_BukuKas') }}',
                        method: 'POST',
                        data: input_create,
                        success: function(data) {
                            if (data.success) {
                                Swal.fire({
                                        title: '<strong>Data Saved Succes</strong>',
                                        icon: 'success',
                                        timer: 5000,
                                        focusConfirm: false,
                                        showConfirmButton: false,
                                    })
                                    .then(function() {
                                        window.location.href =
                                            "{{ route('index_BukuKas') }}";
                                    });
                            } else {
                                Swal.fire({
                                    title: '<strong>Data Tidak Tersimpan</u></strong>',
                                    icon: 'error',
                                    showCloseButton: true,
                                    focusConfirm: false,
                                    confirmButtonText: ' Oke',
                                })
                            }
                        },
                        error: function(error) {
                            Swal.fire({
                                type: 'error',
                                title: 'Opps!',
                                timer: 3000,
                                showConfirmButton: false,
                                text: 'Server Tidak masuk, Tolong Check Kembali!'
                            });
                        }
                    })
                }

            })
        })
    </script>
@endsection
