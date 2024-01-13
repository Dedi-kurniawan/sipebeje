"use strict";

$('.rupiah').mask('000.000.000.000.000,00', {
    reverse: true
});

$( "#harga_final" ).change(function() {
    rupiahTerbilang($("#harga_final").val());    
});

$( "#terbilang_rupiah" ).click(function() {
    rupiahTerbilang($("#harga_final").val());    
});

function rupiahTerbilang(rupiah) {
    var url   = HOST_URL + '/admin/rupiah-terbilang?rupiah='+ rupiah;
    $.get(url, function (d) {
        var terbilang = d.rupiah+ " rupiah";
        $("#harga_final_terbilang").val(terbilang);
    });
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