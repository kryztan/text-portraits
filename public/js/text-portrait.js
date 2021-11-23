$(document).ready(function () {
    $("#image").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(".text-portrait").css(
                    "background-image",
                    "url(" + e.target.result + ")"
                );
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

    $("#submit").click(function () {
        let text = $("#text").val();

        while (text.length < 300000) {
            text += " " + text;
        }

        $(".text-portrait").text(text);
    });

    $("#submit").trigger("click");
});
