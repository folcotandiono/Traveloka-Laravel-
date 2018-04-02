@extends('master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-2">
      <ul class="list-group">
        <a href="#" class="list-group-item list-group-item-action active">Transfer</a>
        <!-- <a href="#" class="list-group-item list-group-item-action">Credit Card</a> -->
      </ul>
    </div>
    <div class="col-md-6">
      <div class="row justify-content-center">
        <h4 id="countdown">00:00:00</h4>
      </div>
      <div class="card">
        <div id="transfer">
          <form action="/upload" method="get" onsubmit="return masihSempat()">
            <input type="text" name="noPemesanan" style="display:none" value="{{ $noPemesanan }}">
            <div class="card-header">
              <h4 class="card-title">
                Transfer
              </h4>
            </div>
            <div class="card-body">
              <div class="input-group">

                @for($i = 0; $i < count($rekening); $i++)
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                      <input type="radio" name="bank" value="{{$rekening[$i]->id}}" required>
                      <label class="form-check-label" for="{{$rekening[$i]->Nama_Bank}}">
                        {{ $rekening[$i] -> Nama_Bank }}
                      </label>
                      <img src="{{asset($rekening[$i]->Directory_Gambar)}}" alt="" height="50" width="100">
                    </div>
                  </div>
                </div>
                @endfor
              </div>
              <h5>Price Details</h5>
              <div class="row justify-content-between">
                <p>{{ $dataPenerbangan[0] -> Nama_Maskapai}} x{{ $banyakPenumpang }}</p>
                <p>{{ $banyakPenumpang * $dataPenerbangan[0] -> Harga_Per_Orang }}</p>
              </div>
              <div class="row justify-content-between">
                <p>Total Price</p>
                <p>{{ $banyakPenumpang * $dataPenerbangan[0] -> Harga_Per_Orang }}</p>
              </div>
              <input type="submit" class="btn btn-warning btn-lg btn-block" value="Pay">
            </div>
          </form>
        </div>
        <div id="creditCard">

        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">
            No. Pemesanan
          </h4>
        </div>
        <div class="card-body">
          {{ $noPemesanan }}
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">YOUR TRIP</h4>
        </div>
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-md-4">
              <p>{{ $dataPenerbangan[0] -> Kota_Asal }}</p>
              <p id="jamBerangkat">{{ $dataPenerbangan[0] -> Jam_Berangkat }}</p>
            </div>
            <div class="col-md-4">
              <img src="{{asset('gambar/ke.png')}}" alt="" height="50" width="50">
            </div>
            <div class="col-md-4">
              <p>{{ $dataPenerbangan[0] -> Kota_Tujuan }}</p>
              <p id="jamTiba">{{ $dataPenerbangan[0] -> Jam_Tiba }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">
            LIST OF PASSENGER(S)
          </h4>
        </div>
        <div class="card-body">
          @for($i = 0; $i < count($travelerDetailsTitle); $i++)
          <p>{{ $travelerDetailsTitle[$i] . " " . $travelerDetailsFullName[$i] }}</p>
          @endfor
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
  var seconds_left;
  $(document).ready(function() {
    var deadlinePembayaran = new Date('{{ $deadlinePembayaran }}');
    var now = new Date('{{ $waktuSekarang }}');
    seconds_left = deadlinePembayaran.getTime() - now.getTime();
    seconds_left /= 1000;
    console.log(seconds_left);
    var interval = setInterval(function() {
        document.getElementById('countdown').innerHTML = formatDetikKeJam(seconds_left);

        if (seconds_left <= 0)
        {
            clearInterval(interval);
        }
        --seconds_left;
    }, 1000);
  });
  function masihSempat() {
    if (seconds_left > 0) return true;
    return false;
  }
</script>
@endsection
