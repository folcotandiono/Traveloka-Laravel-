@extends('master')

@section('content')
  <div class="container">
    <div class="col-md-12" style="border-style: solid; border-width: 1px;">
      <div class="row">
        <div class="col-md-4">
          <div class="row">
            1. Flight Destination
          </div>
        </div>
        <div class="col-md-4">
          <div class="row">
            2. Date of Flight
          </div>
        </div>
        <div class="col-md-4">
          <div class="row">
            3. Search Flights
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4" style="border-style: solid; border-width: 0px 1px 0px 0px;">
          <div class="row align-items-center">
            <img src="{{asset('gambar/planefly.png')}}" height="42" width="42">
            <div class="col">
              <p>From:</p>
              <select id="from">
                @foreach($negara as $negaralist)
                  <option value={{ $negaralist->Nama_Negara }}>{{ $negaralist->Nama_Negara }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row align-items-center justify-content-center">
            <div class="col-md-8">
              <img src="{{asset('gambar/swap.png')}}" height="42" width="42" id="swap">
            </div>
          </div>
          <div class="row align-items-center">
            <img src="{{asset('gambar/planeland.png')}}" height="42" width="42">
            <div class="col">
              <p>To:</p>
              <select id="to">
                @foreach($negara as $negaralist)
                  <option value={{ $negaralist->Nama_Negara }}>{{ $negaralist->Nama_Negara }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="col-md-4" style="border-style: solid; border-width: 0px 1px 0px 0px;">
          <div class="row align-items-center">
            <img src="{{asset('gambar/calendar.png')}}" height="30" width="30">
            <div class="col">
              <p>Departure:</p>
              <input type="date" class="form-control" id="dateFlight">
            </div>
          </div>
        </div>
        <div class="col-md-4" style="border-style: solid; border-width: 0px 0px 0px 0px;">
          <div class="row align-items-center">
            How many people
            <select style="margin-left:10px" id="banyakOrang">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <div class="form-group">
            <button class="btn btn-warning form-control" id="searchFlights">Search Flights</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script type="text/javascript">
  document.getElementById("swap").addEventListener("click", function(){
    var fromSelect = document.getElementById("from");
    var from = fromSelect.options[fromSelect.selectedIndex].value;

    var toSelect = document.getElementById("to");
    var to = toSelect.options[toSelect.selectedIndex].value;

    fromSelect.value = to;
    toSelect.value = from;
  });
  document.getElementById("searchFlights").addEventListener("click", function(){
    // console.log("haha");
    var fromSelect = document.getElementById("from");
    var from = fromSelect.options[fromSelect.selectedIndex].value;

    var toSelect = document.getElementById("to");
    var to = toSelect.options[toSelect.selectedIndex].value;

    if (from == to) {
      toastr.warning('Kota asal dan kota tujuan tidak boleh sama..!!!');
      return;
    }

    var dateFlight = document.getElementById("dateFlight").value;

    if (dateFlight == null || dateFlight == "") {
      toastr.warning('Tanggal penerbangan harap diisi..!!!');
      return;
    }

    var banyakOrangSelect = document.getElementById("banyakOrang");
    var banyakOrang = banyakOrangSelect.options[banyakOrangSelect.selectedIndex].value;

    var url = "{{URL::to('/findticket')}}";
    url += "/" + from;
    url += "/" + to;
    url += "/" + dateFlight;
    url += "/" + banyakOrang;

    window.open(url);
  });
</script>
@endsection('content')