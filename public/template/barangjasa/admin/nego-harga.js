"use strict";

$('.rupiah').mask('000.000.000.000.000,00', {
    reverse: true
});

$( "#penawaran_diajukan" ).change(function() {
    rupiahTerbilang($("#penawaran_diajukan").val());    
});

$( "#terbilang_rupiah" ).click(function() {
    rupiahTerbilang($("#penawaran_diajukan").val());    
});

function rupiahTerbilang(rupiah) {
    var url   = HOST_URL + '/admin/rupiah-terbilang?rupiah='+ rupiah;
    $.get(url, function (d) {
        var terbilang = d.rupiah+ " rupiah";
        $("#penawaran_diajukan_terbilang").val(terbilang);
    });
}

$( "#penawaran_rekanan" ).change(function() {
    rupiahRekananTerbilang($("#penawaran_rekanan").val());    
});

$( "#penawaran_rekanan_terbilang_rupiah" ).click(function() {
    rupiahRekananTerbilang($("#penawaran_rekanan").val());    
});

function rupiahRekananTerbilang(rupiah) {
    var url   = HOST_URL + '/admin/rupiah-terbilang?rupiah='+ rupiah;
    $.get(url, function (d) {
        var terbilang = d.rupiah+ " rupiah";
        $("#penawaran_rekanan_terbilang").val(terbilang);
    });
}


var quill = new Quill("#editor", {
    theme: "snow",
    modules: {
        toolbar: [
            [{
                font: []
            }, {
                size: []
            }],
            ["bold", "italic", "underline", "strike"],
            [{
                color: []
            }, {
                background: []
            }],
            [{
                script: "super"
            }, {
                script: "sub"
            }],
            [{
                header: [!1, 1, 2, 3, 4, 5, 6]
            }, "blockquote", "code-block"],
            [{
                list: "ordered"
            }, {
                list: "bullet"
            }, {
                indent: "-1"
            }, {
                indent: "+1"
            }],
            ["direction", {
                align: []
            }],
            ["clean"]
        ]
    }
});
quill.on('text-change', function(delta, oldDelta, source) {
    document.querySelector("input[name='uraian_klarifikasi']").value = quill.root.innerHTML;
});