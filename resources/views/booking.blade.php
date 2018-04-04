@extends('master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <form action="/booking/simpan" method="post" onsubmit="return validation()">
                  @csrf
                <input type="text" style="display:none" name="noPenerbangan" value="{{ $dataPenerbangan[0] -> No_Penerbangan }}">
                <input type="text" style="display:none" name="banyakPenumpang" value="{{ $banyakPenumpang }}">
                    <h3>Contact Details</h3>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                Contact Details
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="contactDetailsFullName">Full Name</label>
                                <input type="text" class="form-control" name="contactDetailsFullName" id="contactDetailsFullName" aria-describedby="contactDetailsFullNameHelp" required>
                                <small id="contactDetailsFullNameHelp" class="form-text text-muted">As on ID Card/passport/driving license (without degree or special characters)</small>
                            </div>
                            <div class="form-group">
                                <label for="mobileNumber">Mobile Number</label>
                                <input type="number" class="form-control" id="mobileNumber" aria-describedby="mobileNumberHelp" required>
                                <input type="text" style="display:none" name="contactDetailsMobileNumber" id="contactDetailsMobileNumber">
                                <small id="mobileNumberHelp" class="form-text text-muted">e.g. +62812345678, for Country Code (+62) and Mobile No. 0812345678</small>
                            </div>
                            <div class="form-group">
                                <label for="contactDetailsEmail">Email</label>
                                <input type="email" class="form-control" name="contactDetailsEmail" id="contactDetailsEmail" aria-describedby="emailHelp" required>
                                <small id="emailHelp" class="form-text text-muted">e.g. email@example.com</small>
                            </div>
                        </div>
                    </div>
                    <h3>Traveler Details</h3>
                    @for ($i = 0; $i < $banyakPenumpang; $i++)
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Traveler {{ $i + 1 }}
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="travelerDetailsTitle[]">Title</label>
                                    <select class="form-control" name="travelerDetailsTitle[]" id="travelerDetailsTitle[]">
                                        <option value="Mr.">Mr.</option>
                                        <option value="Mrs.">Mrs.</option>
                                        <option value="Ms.">Ms.</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="travelerDetailsFullName[]">Full Name</label>
                                    <input type="text" class="form-control" name="travelerDetailsFullName[]" id="travelerDetailsFullName[]" aria-describedby="travelerDetailsFullNameHelp" required>
                                    <small id="travelerDetailsFullNameHelp" class="form-text text-muted">(without title and punctuation)</small>
                                </div>
                            </div>
                        </div>
                    @endfor
                    <h3>Price Details</h3>
                    <div class="card">
                      <div class="card-header">
                        <h4 class="card-title">
                          <div class="row justify-content-between">
                            <p>Price you pay</p>
                            <p>{{ $banyakPenumpang * $dataPenerbangan[0] -> Harga_Per_Orang }}</p>
                          </div>
                        </h4>
                        <input type="text" style="display:none" name="hargaTotal" value="{{ $banyakPenumpang * $dataPenerbangan[0] -> Harga_Per_Orang }}">
                      </div>
                    </div>
                    <input type="submit" class="btn btn-warning btn-lg btn-block" id="payment" value="Continue">
                </form>
            </div>
            <div class="col-md-4">
                <h3>Your Booking</h3>
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">
                      <img src="{{ asset('gambar/planefly.png') }}" alt="" height="50" width="50">
                      {{ $dataPenerbangan[0] -> Kota_Asal }}
                      <img src="{{ asset('gambar/ke.png') }}" alt="" height="25" width="25">
                      {{ $dataPenerbangan[0] -> Kota_Tujuan }}
                    </h4>
                  </div>
                  <div class="card-body">
                    <p id="tanggalPenerbangan">{{ $dataPenerbangan[0] -> Tanggal }}</p>
                    <div class="row align-items-center">
                      <img src="" alt="" height="50" width="50" id="gambarMaskapai">
                      <p>{{ $dataPenerbangan[0] -> Nama_Maskapai }}</p>
                    </div>
                    <div class="row align-items-center">
                      <div class="col-md-6">
                          <p id="jamBerangkat">{{ $dataPenerbangan[0] -> Jam_Berangkat }}</p>
                          <p id="tanggalBerangkat">{{ $dataPenerbangan[0] -> Tanggal }}</p>
                      </div>
                      <div class="col-md-6">
                        <p>{{ $dataPenerbangan[0] -> Kota_Asal}}</p>
                      </div>
                    </div>
                    <div class="row align-items-center justify-content-center">
                      <img src="{{asset('gambar/arrowdown.png')}}" alt="" height="50" width="50">
                    </div>
                    <div class="row align-items-center">
                      <div class="col-md-6">
                        <p id="jamTiba">{{ $dataPenerbangan[0] -> Jam_Tiba }}</p>
                        <p id="tanggalTiba">{{ $dataPenerbangan[0] -> Tanggal }}</p>
                      </div>
                      <div class="col-md-6">
                        <p>{{ $dataPenerbangan[0] -> Kota_Tujuan }}</p>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
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
    <script src="{{asset('js/intlTelInput.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#mobileNumber").intlTelInput({
                utilsScript: "{{asset('js/utils.js')}}",
                preferredCountries: ["id", "my"]
            });
            var namaMaskapai = '{{ $dataPenerbangan[0] -> Nama_Maskapai }}';
            if (namaMaskapai == 'Garuda Indonesia') {
              $('#gambarMaskapai').attr('src', '{{ asset('gambar/garuda.jpg') }}');
            }
            else if (namaMaskapai == 'Adam Air') {
              $('#gambarMaskapai').attr('src', '{{ asset('gambar/adamair.png')}}');
            }
            else if (namaMaskapai == 'Air Asia') {
              $('#gambarMaskapai').attr('src', '{{ asset('gambar/airasia.jpg')}}');
            }
            else if (namaMaskapai == 'Citilink') {
              $('#gambarMaskapai').attr('src', '{{ asset('gambar/citilink.png')}}');
            }
            else if (namaMaskapai == 'Lion Air') {
              $('#gambarMaskapai').attr('src', '{{ asset('gambar/lionair.png')}}');
            }

            var tanggalPenerbangan = $('#tanggalPenerbangan').text();
            tanggalPenerbangan = moment(tanggalPenerbangan).format('ddd, DD MMM YYYY');
            $('#tanggalPenerbangan').text(tanggalPenerbangan);

            var jamBerangkat = $('#jamBerangkat').text();
            $('#jamBerangkat').text(formathhmmss(jamBerangkat));

            var jamTiba = $('#jamTiba').text();
            $('#jamTiba').text(formathhmmss(jamTiba));

            var tanggalBerangkat = $('#tanggalBerangkat').text();
            $('#tanggalBerangkat').text(moment(tanggalBerangkat).format('DD MMM YYYY'));

            var tanggalTiba = $('#tanggalTiba').text();
            $('#tanggalTiba').text(moment(tanggalTiba).format('DD MMM YYYY'));
        });
        function validation() {
            var valid = $("#mobileNumber").intlTelInput("isValidNumber");
            if (valid == false) {
                toastr.warning('Contact Details Phone Number is not valid..!!!');
                return false;
            }
            var nomor = $("#mobileNumber").intlTelInput("getNumber");
            $("#contactDetailsMobileNumber").val(nomor);
            return true;
        }
    </script>
@endsection
