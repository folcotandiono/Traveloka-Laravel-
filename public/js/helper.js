function addZero(n) {
	if (n < 10) n = '0' + n;
	return n;
}

function formathhmmss(jam) {
	var a = jam.split(':');
	return a[0] + " : " + a[1];
}

function formatMenitKeJam(n) {
	var jam = parseInt(n / 60);
	var menit = n % 60;
	if (jam > 0) {
		return jam + " jam " + menit + " menit";
	}
	else return menit + " menit";
}

function formatKeRupiah(n) {
	n = parseInt(n);
	return "Rp. " + n.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
}

function getLamaPenerbangan(jamBerangkat, jamTiba) {
	var a = jamBerangkat.split(':');
	var berangkat = parseInt(a[0]) * 60 + parseInt(a[1]);
	a = jamTiba.split(':');
	var tiba = parseInt(a[0]) * 60 + parseInt(a[1]);
	var diff = tiba - berangkat;
	var jam = parseInt(diff / 60);
	var menit = diff % 60;
	var hasil = "";
	if (jam > 0) hasil += jam + " jam ";
	if (menit > 0) hasil += menit + " menit";
	return hasil;
}

function formatDetikKeJam(n) {
	var jam = parseInt(n / 3600);
	var menit = parseInt(n / 60);
	var detik = parseInt(n % 60);
	return addZero(jam) + ":" + addZero(menit) + ":" + addZero(detik);
}
