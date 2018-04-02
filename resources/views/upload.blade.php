@extends('master')

@section('content')
<form class="" action="/finish" method="post" enctype="multipart/form-data">
  
  <input type="text" name="noPemesanan" style="display:none" value="{{ $noPemesanan }}">
  <div class="container">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">
            Upload payment
          </h4>
        </div>
        <div class="card-body">
          <div class="row align-items-center">
            <p>{{ $rekening[0] -> Nama_Bank}}</p>
            <img src="{{asset($rekening[0] -> Directory_Gambar)}}" alt="" height="50" width="100">
          </div>
          <div class="row align-items-center">
            <p>No. Rekening</p>
            <p>{{ $rekening[0] -> No_Rekening }}</p>
          </div>
          <input type="file" class="form-control-file" name="gambar" id="gambar" required>
          <input type="submit" class="btn btn-primary" value="Upload">
        </div>
      </div>
    </div>
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
<script src="{{asset('js/intlTelInput.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>

</script>
@endsection
