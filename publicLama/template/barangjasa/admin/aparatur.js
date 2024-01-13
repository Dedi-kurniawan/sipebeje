"use strict";

function createData() {
    $(".modal-title").html("FORMULIR TAMBAH DATA APARATUR DESA");
    $("#submitData").val("add");
    $(".method-hidden").html("");
    $("#submitData").html('<i class="fa fa-save"></i> Simpan');
    $("#formModal").modal("show");
}

var table = $('#datatable').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    "pageLength": 50,
    "lengthMenu": [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "Semua"]
    ],
    ajax: {
        method: 'POST',
    	url: HOST_URL + '/dt/admin/master/aparatur',  
        data: function (d) {
            d.kecamatan_id = $("#kecamatan_filter").val();
            d.desa_id = $("#desa_filter").val();
            d.nama = $("#nama_filter").val();
        }     
    },
    columns: [{
            data: 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {
            data: 'desa.nama',
            name: 'desa.nama',
            orderable: true,
            searchable: true,
        },
        {
            data: 'nama',
            name: 'nama',
            orderable: true,
            searchable: true,
        },
        {
            data: 'jabatan',
            name: 'jabatan',
            orderable: true,
            searchable: true,
        },
        {
            data: 'status_format',
            name: 'status_format',
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
        "lengthMenu": "_MENU_",
        "zeroRecords": "DATA TIDAK ADA ",
        "info": "",
        "infoEmpty": "",
        "infoFiltered": "",
        "search": "_INPUT_",
        "searchPlaceholder": "Cari...",
        "processing":'<div class="spinner spinner-primary spinner-left mr-3">loading...</div>',
        paginate: {
            previous: "<i class='mdi mdi-chevron-left'>",
            next: "<i class='mdi mdi-chevron-right'>"
        }
    },
    "fnDrawCallback": function() {
        var api = this.api();
        var json = api.ajax.json();
        $("#total_data").html(json.recordsTotal);
        $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
        finishLoadingFilter();
    }
});

$("#button_filter").on("click", function() {
    startLoadingFilter();
    table.ajax.reload();
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
        var url = HOST_URL + '/admin/aparatur';
        var title = "TAMBAH DATA";
        var icon  = "success";
    } else if (action == "edit") {
        var id    = $("#id_edit").val();
        var url   = HOST_URL + '/admin/aparatur/' + id;
        var title = "UBAH DATA";
        var icon  = "information";
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
                notifToast(icon, title, d.message);
                return false;
            } else if ((d.status == 'error')) {
                $("#formModal").modal("hide");
                $("#form_validate")[0].reset();
                $(".method-hidden").html("");
                table.ajax.reload(null, false);
                notifToast("warning", title, d.message);
                return false;
            }
        }
    });
});

$('#datatable tbody').on('click', '#editData', function() {
    let id    = $(this).data('id');
    var url   = HOST_URL + '/admin/aparatur/' + id + '/edit';
    $('input').removeClass("is-valid").removeClass("is-invalid");
    $.get(url, function (d) {
        if (d.status == 'success') {
            $.each(d.edit, function (key, value) {
                if (key == "jabatan") {
                    $('#jabatan').val(value).trigger('change');
                } else {
                    $('#'+ key).val(value);
                }
            });
            $("#id_edit").val(id);
            $(".modal-title").html("FORMULIR UBAH DATA APARATUR DESA");
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
                url: HOST_URL + '/admin/aparatur/' + id,
                method: "DELETE",
                dataType: 'json',
                success: function (d) {
                    finishLoading();
                    if (d.status == 'success') {
                        table.ajax.reload(null, false);
                        notifToast("error", title, d.message);
                        return false;
                    } else if (d.status == 'error') {
                        table.ajax.reload(null, false);
                        notifToast("warning", title + " GAGAL" , d.message);
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
            var title = "UBAH STATUS OPERATOR";
            var action = "edit";
            $.ajax({
                url: HOST_URL + '/admin/aparatur-status/'+id,
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

// $("#kecamatan_id").on("change", function (e) {
//     return getDesa($("#kecamatan_id").val());
// });

$("#kecamatan_filter").on("change", function (e) {
    return getFilterDesa($("#kecamatan_filter").val());
});

function getFilterDesa(kecamatan_id, desa_id) {
    $.ajax({
        url: HOST_URL + '/admin/get-desa',
        method: "GET",
        data: {
            kecamatan_id : kecamatan_id,
            desa_id : desa_id,
        },
        dataType: 'json',
        success: function(data) {
            console.log(data)
            $("#desa_filter").html('');
            $("#desa_filter").html(data.options);
            return false;
        }
    });
} 