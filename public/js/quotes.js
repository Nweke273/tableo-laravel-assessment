document.addEventListener("DOMContentLoaded", function () {
    document.body.style.visibility = "hidden";
    $("#quote").hide();
    $("#loader-text").removeClass("d-none");
    document.body.style.visibility = "visible";
    $("#quote").show();
    $("#loader-text").hide();
    function fetchQuotes() {
        return $.ajax({
            url: "/api/quotes",
            method: "GET",
        })
            .done(function (data) {
                $("#quotes-list").empty();
                data.forEach(function (quote) {
                    $("#quotes-list").append(
                        "<div class='quote-item'><p>" + quote + "</p></div>"
                    );
                });
                $("#loader-text").hide();
                $("#quote").show();
                document.body.style.visibility = "visible";
            })
            .fail(function (xhr) {
                if (xhr.status === 401) {
                    window.location.href = "/login";
                } else {
                    alert("An error occurred. Please try again.");
                }
            });
    }

    $("#refresh-quotes").click(function () {
        var $button = $(this);
        var $spinner = $button.find(".spinner-border");

        $spinner.removeClass("d-none");

        fetchQuotes().always(function () {
            $spinner.addClass("d-none");
        });
    });
});
