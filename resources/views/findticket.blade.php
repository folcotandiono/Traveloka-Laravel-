@extends('master')

@section('content')
<div class="container">
    <div class="col-md-12">
      <div class="row">
        <p id="awal">{{$from}}</p>
        <img src="{{asset('gambar/ke.png')}}" height="32" width="32">
        <p id="tujuan">{{$to}}</p>
      </div>
      <div class="row align-items-center">
        <p id="tanggalPenerbangan">{{$dateFlight}}</p>
        <p style="margin-left:10px; margin-right:10px">|</p>
        <p id="banyakPenumpang">{{$banyakOrang}} orang</p>
      </div>
    </div>
    <div class="col-md-12">
      <div class="row align-items-center">
        <p>Filter : </p>
        <button style="margin-left:10px" type="button" class="btn btn-primary" id="btnFilterAirline">Airline</button>
        <button style="margin-left:10px" type="button" class="btn btn-primary" id="btnFilterTime">Time</button>
        <button style="margin-left:10px" type="button" class="btn btn-primary" id="btnFilterDuration">Duration</button>
        <button style="margin-left:10px" type="button" class="btn btn-primary" id="btnFilterPricePerPerson">Price Per Person</button>
      </div>
    </div>
    <div class="col-md-12" id="filterAirline" >
      <input type="checkbox" id="filterAirlineCitilink" class="filter" value="Airline : Citilink"><img src='{{asset('gambar/citilink.png')}}' height='100' width='150'></img>Citilink<br>
      <input type="checkbox" id="filterAirlineLionAir" class="filter" value="Airline : Lion Air"><img src='{{asset('gambar/lionair.png')}}' height='100' width='150'></img>Lion Air<br>
      <input type="checkbox" id="filterAirlineAdamAir" class="filter" value="Airline : Adam Air"><img src='{{asset('gambar/adamair.png')}}' height='100' width='150'></img>Adam Air<br>
      <input type="checkbox" id="filterAirlineAirAsia" class="filter" value="Airline : Air Asia"><img src='{{asset('gambar/airasia.jpg')}}' height='100' width='150'></img>Air Asia<br>
      <input type="checkbox" id="filterAirlineGaruda" class="filter" value="Airline : Garuda"><img src='{{asset('gambar/garuda.jpg')}}' height='100' width='150'></img>Garuda
    </div>
    <div class="col-md-12" id="filterTime" >
      <div class="row">
        <div class="col-md-6">
          <p>Depart</p>
          <input type="checkbox" id="filterDepart0" class="filter" value="Depart : 00.00 - 06.00"> 00.00 - 06.00<br>
          <input type="checkbox" id="filterDepart1" class="filter" value="Depart : 06.00 - 12.00"> 06.00 - 12.00<br>
          <input type="checkbox" id="filterDepart2" class="filter" value="Depart : 12.00 - 18.00"> 12.00 - 18.00<br>
          <input type="checkbox" id="filterDepart3" class="filter" value="Depart : 18.00 - 00.00"> 18.00 - 00.00<br>
        </div>
        <div class="col-md-6">
          <p>Arrive</p>
          <input type="checkbox" id="filterArrive0" class="filter" value="Arrive : 00.00 - 06.00"> 00.00 - 06.00<br>
          <input type="checkbox" id="filterArrive1" class="filter" value="Arrive : 06.00 - 12.00"> 06.00 - 12.00<br>
          <input type="checkbox" id="filterArrive2" class="filter" value="Arrive : 12.00 - 18.00"> 12.00 - 18.00<br>
          <input type="checkbox" id="filterArrive3" class="filter" value="Arrive : 18.00 - 00.00"> 18.00 - 00.00<br>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <p>Duration</p>
      <div class="col-md-4">
        <div id="filterDuration" class="filterSlider"></div>
      </div>
    </div>
    <div class="col-md-12">
      <p>Price Per Person</p>
      <div class="col-md-4">
        <div id="filterPricePerPerson" class="filterSlider"></div>
      </div>
    </div>
    <div class="col-md-12" id="filter" >
      <div class="row">
        <p>Filters : </p>
        <input type="text" class="form-control" id="filterTags">
      </div>
    </div>
    <div class="col-md-12">
      <div class="row">
        <table class="table table-hover" id="tabelPenerbangan">
          <thead>
            <tr>
              <th scope="col">Airline</th>
              <th scope="col">Depart</th>
              <th scope="col">Arrive</th>
              <th scope="col">Duration</th>
              <th scope="col">Price per person</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
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
  <script type="text/javascript">
  var awal, tujuan, banyakHari, banyakPenumpang, tanggalPenerbangan;

  var hargaTermurah = 1000000000, hargaTermahal = -1000000000;

  function cekHargaTermurahDanTermahal(dataPenerbangan) {
    hargaTermurah = 1000000000, hargaTermahal = -1000000000;

    for (var i = 0; i < dataPenerbangan.length; i++) {
      var namaMaskapai = dataPenerbangan[i]["Nama_Maskapai"];
      var jamBerangkat = dataPenerbangan[i]["Jam_Berangkat"]["date"];
      var jamTiba = dataPenerbangan[i]["Jam_Tiba"]["date"];
      var lamaPenerbangan = dataPenerbangan[i]["Lama_Penerbangan"];
      var hargaPerOrang = dataPenerbangan[i]["Harga_Per_Orang"];

      hargaTermurah = Math.min(hargaTermurah, hargaPerOrang);
      hargaTermahal = Math.max(hargaTermahal, hargaPerOrang);
    }
  }

  function tampilkan(dataPenerbangan) {

    $("#tabelPenerbangan tbody").empty();

    var temp = "";

    for (var i = 0; i < dataPenerbangan.length; i++) {
      var namaMaskapai = dataPenerbangan[i]["Nama_Maskapai"];
      var jamBerangkat = dataPenerbangan[i]["Jam_Berangkat"];
      var jamTiba = dataPenerbangan[i]["Jam_Tiba"];
      var lamaPenerbangan = jamTiba - jamBerangkat;
      var hargaPerOrang = dataPenerbangan[i]["Harga_Per_Orang"];

      var gambarPesawat;

      if (namaMaskapai == "Citilink") gambarPesawat = "<img src='{{asset('gambar/citilink.png')}}' height='100' width='150'></img>";
      else if (namaMaskapai == "Lion Air") gambarPesawat = "<img src='{{asset('gambar/lionair.png')}}' height='100' width='150'></img>";
      else if (namaMaskapai == "Adam Air") gambarPesawat = "<img src='{{asset('gambar/adamair.png')}}' height='100' width='150'></img>";
      else if (namaMaskapai == "Air Asia") gambarPesawat = "<img src='{{asset('gambar/airasia.jpg')}}' height='100' width='150'></img>";
      else if (namaMaskapai == "Garuda Indonesia") gambarPesawat = "<img src='{{asset('gambar/garuda.jpg')}}' height='100' width='150'></img>";

      var buttonChoose = "<button type='button' class='btn btn-warning'>Choose</button>";
      document.addEventListener("click", function() {
        // $.ajax({
        //   type: "POST",
        //   url: "findticket.php",
        //   data: {
        //     awal: awal,
        //     tujuan: tujuan,
        //     banyakHari: banyakHari,
        //     banyakPenumpang: banyakPenumpang,
        //     namaMaskapai: namaMaskapai,
        //     jamBerangkat: jamBerangkat,
        //     jamTiba: jamTiba,
        //     lamaPenerbangan: lamaPenerbangan,
        //     hargaPerOrang: hargaPerOrang
        //   },
        //   dataType: 'json',
        //   async: false,
        //   success: function(result){

        //   }
        // });
      });

      temp += "<tr><td>" + 
      gambarPesawat + 
      dataPenerbangan[i]["Nama_Maskapai"] + "</td><td>" + 
      formathhmmss(jamBerangkat) + "</td><td>" + 
      formathhmmss(jamTiba) + "</td><td>" + 
      getLamaPenerbangan(jamBerangkat, jamTiba) + "</td><td>" + 
      formatKeRupiah(hargaPerOrang) + "<br>"+ buttonChoose + "</td></tr>"; 
      // console.log(temp);
    }

  // console.log(temp);

  $("#tabelPenerbangan tbody").append(temp);
}

function filterDataPenerbangan() {
    var airline = [];

    if (document.getElementById("filterAirlineGaruda").checked) airline.push("Garuda Indonesia");
    if (document.getElementById("filterAirlineCitilink").checked) airline.push("Citilink");
    if (document.getElementById("filterAirlineAirAsia").checked) airline.push("Air Asia");
    if (document.getElementById("filterAirlineAdamAir").checked) airline.push("Adam Air");
    if (document.getElementById("filterAirlineLionAir").checked) airline.push("Lion Air");

    var depart = [];

    if (document.getElementById("filterDepart0").checked) depart.push(new Array("00:00", "06:00"));
    if (document.getElementById("filterDepart1").checked) depart.push(new Array("06:00", "12:00"));
    if (document.getElementById("filterDepart2").checked) depart.push(new Array("12:00", "18:00"));
    if (document.getElementById("filterDepart3").checked) depart.push(new Array("18:00", "23:59"));

    var arrive = [];

    if (document.getElementById("filterArrive0").checked) arrive.push(new Array("00:00", "06:00"));
    if (document.getElementById("filterArrive1").checked) arrive.push(new Array("06:00", "12:00"));
    if (document.getElementById("filterArrive2").checked) arrive.push(new Array("12:00", "18:00"));
    if (document.getElementById("filterArrive3").checked) arrive.push(new Array("18:00", "23:59"));

    var duration =  $('#filterDuration').slider("option", "values");

    var pricePerPerson =  $('#filterPricePerPerson').slider("option", "values");

    var sql = "SELECT * FROM Jadwal WHERE Kota_Asal="+awal+" and Kota_Tujuan=" + tujuan+" and Tanggal="+tanggalPenerbangan;

if (airline.length > 0) {
	sql += " and Nama_Maskapai in ("+ "'" + airline.join("','") + "'" +")";

}

if (depart.length > 0) {
	for (var i = 0; i < depart.length; i++) {
		if (i == 0) {
			sql += " and (Jam_Berangkat between 'depart[i][0]' and 'depart[i][1]'";
		}
		else {
			sql += " or Jam_Berangkat between 'depart[i][0]' and 'depart[i][1]'";
		}

	}
	sql += ")";
}

if (arrive.length > 0) {
	for (var i = 0; i < arrive.length; i++) {
		if (i == 0) {
			sql += " and (Jam_Tiba between 'arrive[i][0]' and 'arrive[i][1]'";
		}
		else {
			sql += " or Jam_Tiba between 'arrive[i][0]' and 'arrive[i][1]'";
		}

	}
	sql += ")";

}

if (duration.length > 0) {
	sql += " and (Lama_Penerbangan between " + duration[0] * 60 + " and " + duration[1] * 60 + ")";

}

if (pricePerPerson.length > 0) {
	sql += " and (Harga_Per_Orang between " + pricePerPerson[0] + " and " + pricePerPerson[1] + ")";
	
}

    console.log(sql);

    // console.log(duration);

    // $.ajax({
    //   type: "POST",
    //   url: "filter.php",
    //   data: {
    //     awal: awal,
    //     tujuan: tujuan,
    //     tanggalPenerbangan: tanggalPenerbangan,
    //     banyakPenumpang: banyakPenumpang,
    //     airline: JSON.stringify(airline),
    //     depart: JSON.stringify(depart),
    //     arrive: JSON.stringify(arrive),
    //     duration: JSON.stringify(duration),
    //     pricePerPerson: JSON.stringify(pricePerPerson)
    //   },
    //   dataType: 'json',
    //   success: function(result){
    //     console.log(result);
    //     tampilkan(result);
    //   },
    //   error: function(result) {
    //     console.log(result);
    //   }
    // });
}

$(document).ready(function() {

  var dataPenerbangan = {!! $dataPenerbangan !!};

  tampilkan(dataPenerbangan);
  cekHargaTermurahDanTermahal(dataPenerbangan);

  $( "#filterDuration" ).slider({
    range: true,
    min: 0,
    max: 6
  });

  if (hargaTermahal == -1000000000) {
    $( "#filterPricePerPerson" ).slider({
      range: true,
      min: 0,
      max: 0
    });
  }
  else {
    $( "#filterPricePerPerson" ).slider({
      range: true,
      min: hargaTermurah,
      max: hargaTermahal
    });
  }

    $("#filterPricePerPerson").slider('values',0,hargaTermurah); // sets first handle (index 0) to 50
    $("#filterPricePerPerson").slider('values',1,hargaTermahal); // sets second handle (index 1) to 80
    $("#filterDuration").slider('values',0,0); // sets first handle (index 0) to 50
    $("#filterDuration").slider('values',1,6); // sets second handle (index 1) to 80

  $('#filterTags').tagsinput({
    allowDuplicates: true,
        itemValue: 'id',  // this will be used to set id of tag
        itemText: 'label' // this will be used to set text of tag
      });

  $("#filterTags").on('itemAdded', function(event) {
    filterDataPenerbangan();
  });

  $("#filterTags").on('itemRemoved', function(event) {
    console.log(event);
    if (event.item != undefined) {
      if (event.item.id == "filterDuration") {
          // console.log("hehe");
          $("#filterDuration").slider('values',0,0); // sets first handle (index 0) to 50
          $("#filterDuration").slider('values',1,6); // sets second handle (index 1) to 80
        }
        else if (event.item.id == "filterPricePerPerson") {
          // $("#filterPricePerPerson").slider('values',0,0);
          $("#filterPricePerPerson").slider('values',0,hargaTermurah); // sets first handle (index 0) to 50
          $("#filterPricePerPerson").slider('values',1,hargaTermahal); // sets second handle (index 1) to 80
        }
        else {
          $("#" + event.item.id).attr('checked', false);
        }
      }
      filterDataPenerbangan();
    });

  var filter = document.getElementsByClassName("filter")

  for (var i = 0; i < filter.length; i++) {
    filter[i].addEventListener('change', function() {
      if (this.checked) {
        $('#filterTags').tagsinput('add', { "id": this.id , "label": this.value});
      }
      else {
        $('#filterTags').tagsinput('remove', { "id": this.id });
      }
    });
  }

  $(".filterSlider").on( "slidestop", function( event, ui ) {
    console.log(event.target.id);
    console.log(ui.values);

    if (event.target.id == "filterDuration") {
        if (ui.values[0] == 0 && ui.values[1] == 6) {
          $('#filterTags').tagsinput('remove', { "id": event.target.id });
        }
        else {
          var item = $('#filterTags').tagsinput('items');
          var indeks = -1;
          for (var i = 0; i < item.length; i++) {
            if (item[i].id == event.target.id) {
              indeks = i;
              break;
            }
          }
          if (indeks == -1) $('#filterTags').tagsinput('add', { "id": event.target.id , "label": "Duration : " + ui.values[0] + "h - " + ui.values[1] + "h"});
          else {
            item[i].label = "Duration : " + ui.values[0] + "h - " + ui.values[1] + "h";
          }
          console.log(item);
        }
      }
      else {
        if (ui.values[0] == hargaTermurah && ui.values[1] == hargaTermahal) {
        $('#filterTags').tagsinput('remove', { "id": event.target.id });
        }
        else {
          var item = $('#filterTags').tagsinput('items');
          var indeks = -1;
          for (var i = 0; i < item.length; i++) {
            if (item[i].id == event.target.id) {
              indeks = i;
              break;
            }
          }
          if (indeks == -1) $('#filterTags').tagsinput('add', { "id": event.target.id , "label": "Price Per Person : " + formatKeRupiah(ui.values[0]) + " - " + formatKeRupiah(ui.values[1])});
          else {
            item[i].label = "Price Per Person : " + formatKeRupiah(ui.values[0]) + " - " + formatKeRupiah(ui.values[1]);
          }
          
        }
      }
      $('#filterTags').tagsinput('refresh');
      filterDataPenerbangan();
    } );

});
</script>
@endsection('content')