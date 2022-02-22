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

$('#image-label').on('click', function(e) {
    $('#image-upload').click();
});

$("#image-upload").on("change", function (e) {
    //Get reference of FileUpload.
    var fileUpload = $(this)[0];
    //Check whether the file is valid Image.
    
        //Check whether HTML5 is supported.
        if (typeof (fileUpload.files) != "undefined") {
            //Initiate the FileReader object.
            var reader = new FileReader();
            //Read the contents of Image File.
            reader.readAsDataURL(fileUpload.files[0]);
            reader.onload = function (e) {
                //Initiate the JavaScript Image object.
                var image = new Image();
                //Set the Base64 string return from FileReader as source.
                image.src = e.target.result;
                image.onload = function () {
                    //Determine the Height and Width.
                    var height = this.height;
                    var width = this.width;
                    if (height < 199 || width < 199) {
                        $(".error-image").html("ukuran lebar dan tinggi tidak boleh lebih kecil dari 200x200 pixel");
                        $("#image").val('');
                        return false;
                    }else if(height > 301 || width > 301){
                        $(".error-image").html("ukuran lebar dan tinggi tidak boleh lebih besar dari 300x300 pixel");
                        $("#image").val('');
                        return false;
                    }else{
                        $('#img').attr('src', e.target.result);
                        // $(".image-input-wrapper").attr("style", "background-image:url(" +  e.target.result + "); background-size:cover; background-position: center center");
                        $(".error-image").html("");
                        return true;
                    }
                };
            }
        
    } else {
        $(".error-image").html("Ekstensi yang di dukung .jpg|.png|.jpeg");
        $("#image").val('');
        return false;
    }
});
