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

// HPS BA NEGO
var table = $('#datatable').DataTable({
    processing: true,
    serverSide: true,
    responsive: false,
    scrollX: true,
    searching: false,
    paging: false,
    "deferRender": true,
    "bSortClasses": false,
    "pageLength": 50,
    "lengthMenu": [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "Semua"]
    ],
    ajax: {
        method: 'POST',
    	url: HOST_URL + '/dt/admin/master/hps-ba-nego-harga',
        data: function (d) {
            d.paket_id = $("#paket_id_value").val();
        }
    },
    columns: [{
            data: 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {
            data: 'uraian',
            name: 'uraian',
            orderable: false,
            searchable: false,
        },
        {
            data: 'volume',
            name: 'volume',
            orderable: false,
            searchable: false,
        },
        {
            data: 'harga_satuan_format',
            name: 'harga_satuan_format',
            orderable: false,
            searchable: false,
        },
        {
            data: 'satuan',
            name: 'satuan',
            orderable: false,
            searchable: false,
        },
        {
            data: 'jumlah_format',
            name: 'jumlah_format',
            orderable: false,
            searchable: false,
        },
        {
            data: 'pajak',
            name: 'pajak',
            orderable: false,
            searchable: false,
        },
        {
            data: 'harga_pajak_format',
            name: 'harga_pajak_format',
            orderable: false,
            searchable: false,
        },
        {
            data: 'keterangan',
            name: 'keterangan',
            orderable: false,
            searchable: false,
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false,
        }
    ],
    columnDefs: [{
        "targets": '_all',
        "defaultContent": "-"
    }],
    "language": {
        "lengthMenu": "<div class='ml-2 mt-2'> _MENU_ </div>",
        "zeroRecords": "DATA TIDAK ADA ",
        "info": "",
        "infoEmpty": "",
        "infoFiltered": "",
        "search": "<div class='mr-2 mt-2'>cari : _INPUT_ </div>",
        "searchPlaceholder": "Cari...",
        "processing":'<div class="spinner spinner-primary spinner-left mr-3">loading...</div>',
        paginate: {
            previous: "<",
            next: ">"
        }
    }
});

function createData() {
    $("#formModal").modal("show");
    $("#paket_id").val($("#paket_id_value").val());
    $("#submitData").html('<i class="fa fa-save"></i> Simpan');
    return false;
}

$("#submitData").click(function (event) {
    event.preventDefault();
    startLoading();
    var validat = $("#form_validate_modal").valid();
    var action = $(this).val();
    if (!validat) {
        finishLoading();
        return false;
    }

    var url = HOST_URL + '/admin/hps-ba-nego';
    var title = "TAMBAH HPS";

    $.ajax({
        url: url,
        method: "POST",
        data: $('#form_validate_modal').serialize(),
        dataType: 'json',
        error: function (json) {
            console.log(json);
            finishLoading();
            var errors = $.parseJSON(json.responseText);
            $.each(errors.errors, function (key, value) {
                $("input[name='" + key + "']").after("<label id='" + key + "-error' class='error invalid-feedback' for='" + key + "'>" + value + "</label>");
                $("input[name='" + key + "']").addClass("is-invalid");
            });
            $("#submitData").html('<i class="fa fa-save"></i> Simpan');
        },
        success: function (d) {
            finishLoading();
            if (d.status == 'success') {
                console.log(d.message)
                $("#formModal").modal("hide");
                $("#form_validate")[0].reset();
                table.ajax.reload(null, false);
                notifToast(action, title, d.message);

                location.reload();
                return false;
            } else if ((d.status == 'error')) {
                // $("#formModal").modal("hide");
                $("#form_validate")[0].reset();
                table.ajax.reload(null, false);
                notifToast(d.status, title, d.message);
                return false;
            }
        }
    });
});

$(document).on('click', '#deleteData', function (e) {
    e.preventDefault();
    var id   = $(this).data('id');
    var name = $(this).data('name');
    Swal.fire({
        title: "Apakah kamu yakin?",
        text: "Menghapus "+name,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Tidak, Batal!",
        reverseButtons: true
    }).then(function (result) {
        if (result.value) {
            var title = "Hapus Data";
            var action = "delete";
            $.ajax({
                url: HOST_URL + '/admin/hps-ba-nego/' + id,
                method: "DELETE",
                dataType: 'json',
                success: function (d) {
                    finishLoading();
                    if (d.status == 'success') {
                        table.ajax.reload(null, false);
                        notifToast(action, title, d.message);
                        location.reload();
                        return false;
                    } else if (d.status == 'error') {
                        table.ajax.reload(null, false);
                        notifToast("error", title + " GAGAL" , d.message);
                        return false;
                    }
                },
                error: function (json) {
                    table.ajax.reload(null, false);
                    notifToast("error", title +" GAGAL" , " Minta admin untuk menghapus data");
                    return false;
                },
            });
        } else if (result.dismiss === "cancel") {
            Swal.fire(
                "Batal",
                "Kamu membatalkan  menghapus "+name,
                "error"
            )
        }
    });
});