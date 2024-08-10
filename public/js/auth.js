$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");

    $("#loginForm").on("submit", function (event) {
        event.preventDefault();
        $("#spinner").removeClass("d-none");

        $.ajax({
            url: "/api/login",
            type: "POST",
            data: $(this).serialize(),
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                console.log("Login successful:", response);
                var accessToken = response.access_token;
                localStorage.setItem("accessToken", accessToken);
                $("#spinner").addClass("d-none");
                window.location.href = "/quotes-page";
            },
            error: function (xhr) {
                console.log("Error:", xhr);
                $("#spinner").addClass("d-none");
                $("#error-message").text(
                    xhr.responseJSON.message || "An error occurred"
                );
            },
        });
    });
});
