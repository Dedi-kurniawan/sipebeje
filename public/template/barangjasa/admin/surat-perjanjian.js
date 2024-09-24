"use strict";

$('.rupiah').mask('000.000.000.000.000,00', {
    reverse: true
});

rupiahTerbilang($("#harga_final").val());

$( "#harga_final" ).change(function() {
    rupiahTerbilang($("#harga_final").val());

    var hpsValue = convertToNumber($("#harga_final").val());
    var dendaValue = hpsValue * 0.015;
    var nominalDenda = dendaValue.toLocaleString('id-ID', { minimumFractionDigits: 2 });
    $('#nominal_denda').val(nominalDenda);
    console.log("dendaValue", hpsValue)
});

$( "#terbilang_rupiah" ).click(function() {
    rupiahTerbilang($("#harga_final").val());
});

function rupiahTerbilang(rupiah) {
    var url = HOST_URL + '/admin/rupiah-terbilang?rupiah='+ rupiah;
    $.get(url, function (d) {
        var terbilang = d.rupiah+ " rupiah";
        $("#harga_final_terbilang").val(terbilang);
    });
}

denda();

function denda() {
    var hpsValue = convertToNumber($("#harga_final").val());
    var dendaValue = hpsValue * 0.015;
    var nominalDenda = dendaValue.toLocaleString('id-ID', { minimumFractionDigits: 2 });
    $('#nominal_denda').val(nominalDenda);

    dendaRupiahTerbilang($("#nominal_denda").val());
}

$( "#nominal_denda" ).change(function() {
    dendaRupiahTerbilang($("#nominal_denda").val());
});

$( "#nominal_denda_terbilang_rupiah" ).click(function() {
    dendaRupiahTerbilang($("#nominal_denda").val());
});

function dendaRupiahTerbilang(rupiah) {
    var url   = HOST_URL + '/admin/rupiah-terbilang?rupiah='+ rupiah;
    $.get(url, function (d) {
        var terbilang = d.rupiah+ " rupiah";
        $("#nominal_denda_terbilang").val(terbilang);
    });
}

function convertToNumber(value) {
    var angkaTanpaKomaTitik = value.replace(/\./g, "").replace(",", ".");
    return parseFloat(angkaTanpaKomaTitik);
}

function calculateEndDate() {
    var jangkaWaktu = parseInt($('#jangka_waktu').val()); // Get jangka waktu value
    var mulaiTanggal = $('#mulai_jangka_waktu').val(); // Get start date value

    if (jangkaWaktu && mulaiTanggal) {
        var startDate = new Date(mulaiTanggal);
        startDate.setDate(startDate.getDate() + jangkaWaktu); // Add the number of days to the start date

        var dd = String(startDate.getDate()).padStart(2, '0');
        var mm = String(startDate.getMonth() + 1).padStart(2, '0'); // January is 0
        var yyyy = startDate.getFullYear();

        var endDate = yyyy + '-' + mm + '-' + dd; // Format the date

        $('#selesai_jangka_waktu').val(endDate); // Set the end date field
        $('#diserahkan_jangka_waktu').val(endDate); // Set the end date field
    }
}

// Trigger the calculation when 'jangka_waktu' or 'mulai_jangka_waktu' changes
$('#jangka_waktu, #mulai_jangka_waktu').on('input change', function() {
    calculateEndDate();
});