$(document).ready(function () {
    $(document).on("change", "#image", function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                console.log("wew", e);
                $(".text-portrait").css(
                    "background-image",
                    "url(" + e.target.result + ")"
                );
            };
            reader.readAsDataURL(this.files[0]);
        } else {
            console.log("no");
        }
    });
});
