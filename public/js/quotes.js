document.addEventListener("DOMContentLoaded", function () {
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
            })
            .fail(function (xhr) {
                console.log("Response Text:", xhr.responseText);
                alert("An error occurred. Please try again.");
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
