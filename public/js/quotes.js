document.addEventListener("DOMContentLoaded", function () {
    $("#quote").hide();
    $("#loader-text").removeClass("d-none");
    function checkToken() {
        var accessToken = localStorage.getItem("accessToken");
        if (!accessToken) {
            window.location.href = "/login";
        } else {
            fetchQuotes();
        }
    }

    checkToken();

    function fetchQuotes() {
        var accessToken = localStorage.getItem("accessToken");
        return $.ajax({
            url: "/api/quotes",
            method: "GET",
            headers: {
                Authorization: "Bearer " + accessToken,
            },
        })
            .done(function (data) {
                console.log(data);
                $("#quotes-list").empty();
                data.forEach(function (quote) {
                    $("#quotes-list").append(
                        "<div class='quote-item'><p>" + quote + "</p></div>"
                    );
                });
                $("#loader-text").hide();
                $("#quote").show();
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
