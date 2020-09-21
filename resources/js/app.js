$(document).ready(function () {
    if (window.File && window.FileList && window.FileReader) {

        if (!$('.user-salary').val()) {
            $('.user-salary').val(0);

        }
        if (!$('.user-percent').val()) {
            $('.user-percent').val(0);
        }

        $('.user-percent').focusout(function (e) {
            if (!e.target.value) {
                $('.user-percent').val(0)
            }
        })

        $('.percent-container').css('display', 'none');


        $('.user-salary').focusout(function (e) {
            if (!e.target.value) {
                $('user-salary').val(0)
            }
        })

        $("#salary_type").change(function (e) {
            if (e.target.value == 1) {
                $('.user-percent').val(0)
                $('.percent-container').css('display', 'none');
            } else {
                $('.percent-container').css('display', 'block');
            }
        })
        $("#files").on("change", function (e) {
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                $('.pip').remove();
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function (e) {
                    var file = e.target;
                    $("<span class=\"pip\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                        "<br/><span class=\"remove\">Remove image</span>" +
                        "</span>").insertAfter("#files");
                    $(".remove").click(function () {
                        $(this).parent(".pip").remove();
                        $('input[name ="files"]').val('')

                    });

                });
                fileReader.readAsDataURL(f);
            }
        });
    } else {
        alert("Your browser doesn't support to File API")
    }
});

