@extends('master')

@section('content')
<form action="/booking" method="get">
    <input type="text" name="noPenerbangan" value="{{ $dataPenerbangan[0] -> No_Penerbangan }}" style="display: none">
    <input type="text" name="banyakPenumpang" value="{{ $banyakPenumpang }}" style="display: none">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            Flight from {{ $dataPenerbangan[0] -> Kota_Asal }} to {{ $dataPenerbangan[0] -> Kota_Tujuan }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <p id="dateFlight">
                            {{ $dataPenerbangan[0] -> Tanggal }}
                        </p>
                        <p>
                            {{ $banyakPenumpang }} orang
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-12"> -->
            <div class="row">
                <div class="col-md-8">
                    <!-- <div class="row"> -->
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    {{ $dataPenerbangan[0] -> Kota_Asal }} 
                                    <img src="{{asset('gambar/ke.png')}}" alt="" height="50" width="50">
                                    {{ $dataPenerbangan[0] -> Kota_Tujuan }}
                                </h4>

                            </div>
                            <div class="card-body">
                                <h4 class="card-title" id="tanggal">

                                </h4>
                                <div class="row align-items-center">
                                    <img src="" alt="" height="100" width="100" id="gambarMaskapai">
                                    <p>{{ $dataPenerbangan[0] -> Nama_Maskapai }} </p>
                                    <p style="margin-left:8px"> {{ $dataPenerbangan[0] -> No_Penerbangan }}</p>
                                </div>
                                <div class="row">
                                    
                                    <div class="col-md-2">
                                        <p id="jamBerangkat"></p>
                                        <p>{{ $dataPenerbangan[0] -> Kota_Asal }}</p>
                                    </div>
                                    <img src="{{asset('gambar/ke.png')}}" alt="" height="50" width="50">
                                    <div class="col-md-2">
                                        <p id="jamTiba"></p>
                                        <p>{{ $dataPenerbangan[0] -> Kota_Tujuan }}</p>
                                    </div>
                                    <!-- <div class="col-md-2"> -->
                                        <p id="lamaPenerbangan"></p>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Price Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <p>{{ $dataPenerbangan[0] -> Nama_Maskapai }} x{{ $banyakPenumpang }}</p>
                                <p id="hargaTiket"></p>
                            </div>
                            <div class="row justify-content-between">
                                <p>Price you pay</p>
                                <p id="hargaTotal"></p>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-warning btn-lg btn-block" value="Continue to Booking">
                </div>
            </div>
        <!-- </div> -->
    </div>
</form>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/helper.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/tagsinput.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#tanggal').text(moment('{{ $dataPenerbangan[0] -> Tanggal }}').format('ddd, DD MMM YYYY'));
            var namaMaskapai = '{{ $dataPenerbangan[0] -> Nama_Maskapai }}';
            if (namaMaskapai == "Garuda Indonesia") {
                $('#gambarMaskapai').attr("src","{{asset('gambar/garuda.jpg')}}");
            }
            else if (namaMaskapai == "Air Asia") {
                $('#gambarMaskapai').attr("src","{{asset('gambar/airasia.jpg')}}");
            }

            var jamBerangkat = '{{ $dataPenerbangan[0] -> Jam_Berangkat }}';
            $('#jamBerangkat').text(formathhmmss(jamBerangkat));

            var jamTiba = '{{ $dataPenerbangan[0] -> Jam_Tiba }}';
            $('#jamTiba').text(formathhmmss(jamTiba));

            $('#lamaPenerbangan').text(getLamaPenerbangan(jamBerangkat, jamTiba));

            var hargaTiket = '{{ $banyakPenumpang }}' * '{{ $dataPenerbangan[0] -> Harga_Per_Orang }}';
            $('#hargaTiket').text(hargaTiket);
            $('#hargaTotal').text(hargaTiket);
        });
    </script>
@endsection