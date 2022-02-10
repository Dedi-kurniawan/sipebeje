"use strict";

function createData() {
    $(".modal-title").html("FORMULIR TAMBAH DATA JENIS USAHA/PENGADAAN");
    $("#submitData").val("add");
    $(".method-hidden").html("");
    $("#submitData").html('<i class="fa fa-save"></i> Simpan');
    $("#formModal").modal("show");
}

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
    	url: HOST_URL + '/dt/admin/master/kategori',       
    },
    columns: [{
            data: 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {
            data: 'nama',
            name: 'nama',
            orderable: true,
            searchable: true,
        },
        {
            data: 'status_format',
            name: 'status_format',
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
    },
    "fnDrawCallback": function() {
        var api = this.api();
        var json = api.ajax.json();
        $("#total_data").html(json.recordsTotal);
    }
});

$('#datatable').on('click', '#ubahStatus', function (e) {
    e.preventDefault();
    let id = $(this).data('id');
    let name = $(this).data('name');
    let status_value = $(this).data('status');
    let status = $(this).data('status') == 0 ? "Aktif" : "Tidak Aktif";
    let status_buttons = $(this).data('status') == 0 ? "success" : "error";
    Swal.fire({
        title: "Apakah kamu yakin?",
        text: "Ubah Status " +name+  " Menjadi "+status,
        icon: status_buttons,
        showCancelButton: true,
        confirmButtonText: "Ya, Ubah!",
        cancelButtonText: "Tidak, Batal!",
        reverseButtons: true
    }).then(function (result) {
        if (result.value) {            
            var title = "UBAH STATUS DESA";
            var action = "edit";
            $.ajax({
                url: HOST_URL + '/admin/kategori-status/'+id,
                method: 'POST',
                dataType: 'json',
                data: {
                    status  : status_value,
                },
                success: function (d) {
                    finishLoading();
                    if (d.status == 'success') {
                        Swal.fire(
                            "Ubah status!",
                            "Berhasil ubah "+status,
                            "success"
                        )
                        table.ajax.reload(null, false);
                        notifToast(action, title, d.message);
                        return false;
                    } else {
                        Swal.fire(
                            "Ubah status!",
                            "Error "+d.message,
                            "error"
                        )
                        table.ajax.reload(null, false);
                        notifToast("error", title, d.message);
                        return false;
                    }
                },
                error: function (xhr, thrownError) {
                    if (xhr.status == "401") {
                        Swal.fire(
                            "Ubah status!",
                            "Hanya Admin Kabupaten Yang Di Izinkan Merubah Status",
                            "error"
                        )
                    }else{
                        Swal.fire(
                            "Ubah status!",
                            "Terjadi Kesalah Pada Server, Mohon Di Ulangi",
                            "error"
                        )
                    }                    
                }
            });
        } else if (result.dismiss === "cancel") {
            Swal.fire(
                "Batal",
                "Kamu membatalkan ubah status "+name,
                "error"
            )
        }
    });
});

$("#submitData").click(function (event) {
    event.preventDefault();
    startLoading();
    var validat = $("#form_validate").valid();
    var action = $(this).val();
    if (!validat) {
        finishLoading();
        return false;
    }

    if (action == "add") {
        var url = HOST_URL + '/admin/kategori';
        var title = "TAMBAH DATA";
    } else if (action == "edit") {
        var id    = $("#id_edit").val();
        var url   = HOST_URL + '/admin/kategori/' + id;
        var title = "UBAH DATA";
    }

    $.ajax({
        url: url,
        method: "POST",
        data: $('#form_validate').serialize(),
        dataType: 'json',
        error: function (json) {
            console.log(json);
            finishLoading();
            var errors = $.parseJSON(json.responseText);
            $.each(errors.errors, function (key, value) {
                $("input[name='" + key + "']").after("<label id='" + key + "-error' class='error invalid-feedback' for='" + key + "'>" + value + "</label>");
                $("input[name='" + key + "']").addClass("is-invalid");
            });
        },
        success: function (d) {
            finishLoading();
            if (d.status == 'success') {
                console.log(d.message)
                $("#formModal").modal("hide");
                $("#form_validate")[0].reset();
                $(".method-hidden").html("");
                table.ajax.reload(null, false);
                notifToast(action, title, d.message);
                return false;
            } else if ((d.status == 'error')) {
                $("#formModal").modal("hide");
                $("#form_validate")[0].reset();
                $(".method-hidden").html("");
                table.ajax.reload(null, false);
                notifToast(d.status, title, d.message);
                return false;
            }
        }
    });
});

$('#datatable tbody').on('click', '#editData', function() {
    let id    = $(this).data('id');
    var url   = HOST_URL + '/admin/kategori/' + id + '/edit';
    $('input').removeClass("is-valid").removeClass("is-invalid");
    $.get(url, function (d) {
        if (d.status == 'success') {
            $('#nama').val(d.edit.nama);
            $("#id_edit").val(id);
            $(".modal-title").html("FORMULIR UBAH DATA JENIS USAHA/PENGADAAN");
            $(".text-title").html("UBAH KECAMATAN");
            $("#submitData").val("edit");
            $("#submitData").html('<i class="fa fa-edit"></i> Ubah');
            $(".method-hidden").html("<input type='hidden' name='_method' value='PUT'/>")
            $("#formModal").modal("show");
            return false;
        } else if ((d.status == 'error')) {
            notifToast("error", "EDIT DATA GAGAL", "data tidak di temukan");    
            return false;
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
                url: HOST_URL + '/admin/kategori/' + id,
                method: "DELETE",
                dataType: 'json',
                success: function (d) {
                    finishLoading();
                    if (d.status == 'success') {
                        table.ajax.reload(null, false);
                        notifToast(action, title, d.message);
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