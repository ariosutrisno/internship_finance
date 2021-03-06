@extends('Web.Layouts.app')
@section('title', 'Edit Quotation Letter')
@section('container')
    @include('Web.Layouts.css&js.cssdashboard')
    @include('Web.Layouts.css&js.css')
    @include('Web.Layouts.css&js.jsSelect')
    @include('Web.Layouts.css&js.cssSelect')
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        @include('Web.Dashboard.sidedashboard')
        <div class="page-wrapper">
            <div class="container-fluid">
                <!-- *************************************************************** -->
                <!-- Start First Cards -->
                <!-- *************************************************************** -->
                <div class="container">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-sm-1 mt-1">
                                            <img src="{{ asset('frontend/img/bill.png') }}" alt="Hutang">
                                        </div>
                                        <div class="col-sm-10 ml-3">
                                            <span class="h1 text-cyan"><strong> Quotation Letter </strong></span>
                                            <br><span>buat surat dan berikan kepada orang lain</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('update_QuotationLetter', $item_id_quotation->id_quotation) }}"
                                method="POST">
                                @csrf
                                @include('Web.Surat.types_of_letters.quotation.formEdit')
                                <div class="float-md-right">
                                    <a href="{{ route('index_QuotationLetter') }}"
                                        class="btn  tombol btn-danger  ml-5">Cancel</a>
                                    <button type="submit" class="btn tombol bg-purple  btn-primary ">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Script JS -->
    <script>
        // JQUERY Auto Fill Pelanggan
        $(function() {
            $('#nama').autocomplete({
                source: function(request, response) {

                    $.getJSON('?term=' + request.term, function(data) {
                        var array = $.map(data, function(row) {
                            return {
                                value: row.id_customer,
                                nama: row.name_customer,
                                alamat: row.address_company_customer,
                                email: row.email_customer,
                                telepon: row.phone_customer
                            }
                        })
                        response($.ui.autocomplete.filter(array, request.term));
                    })
                },
                minLength: 1,
                delay: 500,
                select: function(event, ui) {
                    $('#nama').val(ui.item.name)
                    $('#perusahaan').val(ui.item.perusahaan)
                    $('#email').val(ui.item.email)
                    $('#telepon').val(ui.item.telepon)
                }
            })
        })
        // End Auto Fill Pelanggan
        $('#POITable').on('change', 'input[name="cp[]"]', function() {
            var total = 0;
            var ppn = 0.1;
            var wajibpajak = 0;
            var seluruh = 0;
            $('table').find('tr').each(function() {
                var $this = $(this);
                var gg = (parseFloat($this.find('input[name="cp[]"]').val(), 10) || 0);
                total += gg;
                wajibpajak = parseFloat(total) * parseFloat(ppn);
                seluruh = parseInt(total) + parseInt(wajibpajak);
                console.log('keseluruhan:', seluruh)
                console.log('pajak:', wajibpajak);
                console.log('subtotal:', total);
            })
            $('#subtotal').val(total)
            $('#total').val(seluruh)
        })

        function onlynumber(e) {
            if (e.shiftKey === true) {
                if (e.which == 9) {
                    return true;
                }
                return false;
            }
            if (e.which > 57) {
                return false;
            }
            if (e.which == 32) {
                return false;
            }
            return true;
        }
        $(".cp").blur(function() {

            var totalSum = 0;
            $('input.cp').each(function() {
                totalSum += parseFloat(this.value);
            });
            console.log(totalSum);
            // console.log(subtotal)
            // $(".total").text(subtotal);
        });

        $(document).ready(function() {
            var max_fields = 10;
            var wrapper = $(".container1");
            var add_button = $(".add_form_field");
            var dd = $('#POITable tbody tr').length;
            // console.log(dd);
            var min_fields = 1;
            var x = 1;
            $(add_button).click(function(e) {
                e.preventDefault();
                if (x < max_fields) {
                    x++;
                    $(wrapper).append(
                        `<tr class="table-white "><td class="text-right"> <input type="text" class="form-control" id="np" placeholder="Nama Proyek" name="np[]"></input></td><td class="text-right gini"><input type="text" class="form-control cp" id="cp"     placeholder="Biaya Proyek" name="cp[]"    ></input></td><td class="text-center"><a href="#"  id="delete"class="delete btn btn-danger tombol">Delete</a></td></tr>`
                    ); //add input box
                    document.getElementById("delete").setAttribute("style", "display: inline;")
                } else {
                    alert('You Reached the limits')
                }
                console.log('aa', x);
            });
            $(wrapper).on("click", ".delete", function(e) {
                e.preventDefault();
                $(this).parent().parent().remove();
                x--;
                console.log('aaac', x);
                if (x <= min_fields) {
                    document.getElementById("delete").setAttribute("style", "display: none;");
                }
                var total = 0;
                var ppn = 0.1;
                var wajibpajak = 0;
                var seluruh = 0;
                $('table').find('tr').each(function() {
                    var $this = $(this);
                    var gg = (parseFloat($this.find('input[name="cp[]"]').val(), 10) || 0);
                    total += gg;
                    wajibpajak = parseFloat(total) * parseFloat(ppn);
                    seluruh = parseInt(total) + parseInt(wajibpajak);
                    console.log('keseluruhan:', seluruh)
                    console.log('pajak:', wajibpajak);
                    console.log('subtotal:', total);
                })
                $('#subtotal').val(total)
                $('#total').val(seluruh)
                console.log(x);
            })
        });
    </script>
    <script>
        // FORM QUOTATION 
        function fetch_customer_data(query = '') {
            $.ajax({
                url: `${query}`,
                method: 'GET',
                data: {
                    query: query,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data)
                    var email = $("#email").val(data.email_customer)
                    var perusahaan = $("#perusahaan").val(data.address_company_customer)
                    var telepon = $("#telepon").val(data.name_customer)

                }
            });
        }

        function onSelect() {
            var query = document.getElementById("nama").value;
            console.log(query)
            setInterval(fetch_customer_data(query), 5000);
        }
    </script>
    </div>
@endsection
