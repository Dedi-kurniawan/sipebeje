"use strict";

$("#kecamatan_id").on("change", function (e) {
    return getDesa($("#kecamatan_id").val(), "");
});

getDesa($("#kecamatan_id").val(), "");

function getDesa(kecamatan_id, desa_id) {
    console.log(kecamatan_id);
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
            $("#desa_id").html('');
            $("#desa_id").html(data.options);
            if($('#desa_selected').length){
                $('#desa_id').val($("#desa_selected").val()).trigger('change');
            }
            return false;
        }
    });
} 