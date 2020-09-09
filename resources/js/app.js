


$(document).ready(function () {
    if (window.File && window.FileList && window.FileReader) {

        $('.percent-container').css('display','none');
        $('input[name ="percent"]').val(0);
        $('input[name ="salary"]').val(0);
        $('input[name ="percent"]').focusout(function (e) {
            if (!e.target.value) {
                $('input[name ="percent"]').val(0)
            }
        })

        $('input[name ="salary"]').focusout(function (e) {
            if (!e.target.value) {
                $('input[name ="salary"]').val(0)
            }
        })

        $("#salary_type").change(function (e) {
            if (e.target.value == 1) {
                $('.percent-container').css('display','none');
            } else {
                $('.percent-container').css('display','block');
            }
        })
        $("#files").on("change", function(e) {
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                $('.pip').remove();
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                    var file = e.target;
                    $("<span class=\"pip\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                        "<br/><span class=\"remove\">Remove image</span>" +
                        "</span>").insertAfter("#files");
                    $(".remove").click(function(){
                        $(this).parent(".pip").remove();
                    });

                });
                fileReader.readAsDataURL(f);
            }
        });
    } else {
        alert("Your browser doesn't support to File API")
    }
});

