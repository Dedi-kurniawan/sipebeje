"use strict";

var table = $('#datatable').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    scrollX: true,
    autoWidth: true,
    "deferRender": true,
    "bSortClasses": false,
    "pageLength": 50,
    "lengthMenu": [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "Semua"]
    ],
    ajax: {
        method: 'POST',
    	url: HOST_URL + '/dt/admin/master/ba-pekerjaan',
        data: function (d) {
            d.search = $("#search_filter").val();
            d.desa_id = $("#desa_filter").val();
        }
    },
    columns: [{
            data: 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {
            data: 'tanggal',
            name: 'tanggal',
            orderable: true,
            searchable: true,
        },
        {
            data: 'nomor_surat',
            name: 'nomor_surat',
            orderable: true,
            searchable: true,
        },
        {
            data: 'nama_desa',
            name: 'nama_desa',
            orderable: true,
            searchable: true,
        },
        {
            data: 'kepala_desa',
            name: 'kepala_desa',
            orderable: true,
            searchable: true,
        },
        {
            data: 'ketua_tpk',
            name: 'ketua_tpk',
            orderable: true,
            searchable: true,
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
    },
    "fnDrawCallback": function() {
        var api = this.api();
        var json = api.ajax.json();
        $("#total_data").html(json.recordsTotal);
    }
});

function createData() {
    $(".modal-title").html("FORMULIR TAMBAH DATA BERITA ACARA SERAH TERIMA PEKERJAAN BARU");
    $("#submitData").val("add");
    $(".method-hidden").html("");
    $("#submitData").html('<i class="fa fa-save"></i> Simpan');
    $("#formModal").modal("show");
}

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
                url: HOST_URL + '/admin/ba-pekerjaan/' + id,
                method: "DELETE",
                dataType: 'json',
                success: function (d) {
                    finishLoading();
                    if (d.status == 'success') {
                        table.ajax.reload(null, false);
                        notifToast(action, '', d.message);
                        return false;
                    } else if (d.status == 'error') {
                        table.ajax.reload(null, false);
                        notifToast("error", "" , d.message);
                        return false;
                    }
                },
                error: function (json) {
                    table.ajax.reload(null, false);
                    notifToast("error", "" , " Minta admin untuk menghapus data");
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