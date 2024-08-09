function fetchQuotes() {
    return $.ajax({
        url: "/quotes",
        method: "GET",
        success: function (data) {
            console.log(data);
            $("#quotes-list").empty();
            data.forEach(function (quote, index) {
                $("#quotes-list").append(
                    "<div class='quote-item'><p>" + quote + "</p></div>"
                );
            });
            $("#loader").addClass("d-none");
            $("#loader-text").hide();
            $("#quote").show();
        },
        error: function (xhr) {
            console.error("Error loading quotes:", xhr.responseText);
        },
    });
}

$(document).ready(function () {
    $("#quote").hide();
    $("#loader").removeClass("d-none");

    fetchQuotes().always(function () {
        $("#loader").addClass("d-none");
    });

    $("#refresh-quotes").click(function () {
        var $button = $(this);
        var $spinner = $button.find(".spinner-border");

        $spinner.removeClass("d-none");

        fetchQuotes().always(function () {
            $spinner.addClass("d-none");
        });
    });

    $(".view-tables-btn").click(function () {
        var restaurantId = $(this).data("id");
        var viewType = $(this).data("type");
        var tablesContainer = $(".tables-container");
        var loader = $("#tables-loader");
    
        // Show loader
        loader.removeClass("d-none");
    
        $.ajax({
            url: "/restaurants/" + restaurantId + "/tables",
            method: "GET",
            data: {
                type: viewType,
            },
            success: function (data) {
                tablesContainer.empty();
                loader.addClass("d-none"); // Hide loader
    
                if (data.length === 0) {
                    tablesContainer.html("<p>No tables available.</p>");
                } else {
                    if (viewType === "active") {
                        var groupedTables = {};
                        $.each(data, function (index, table) {
                            if (!groupedTables[table.dining_area]) {
                                groupedTables[table.dining_area] = [];
                            }
                            groupedTables[table.dining_area].push(table);
                        });
    
                        var tableList = "<table>";
                        tableList +=
                            "<thead><tr><th>Name</th><th>Min Capacity</th><th>Max Capacity</th><th>Status</th></tr></thead>";
                        tableList += "<tbody>";
    
                        $.each(
                            groupedTables,
                            function (diningAreaName, tables) {
                                tableList +=
                                    "<tr class='group-name'><td colspan='4'><strong>" +
                                    diningAreaName +
                                    "</strong></td></tr>";
    
                                $.each(tables, function (index, table) {
                                    tableList += "<tr>";
                                    tableList += "<td>" + table.name + "</td>";
                                    tableList +=
                                        "<td>" + table.min_capacity + "</td>";
                                    tableList +=
                                        "<td>" + table.max_capacity + "</td>";
                                    tableList +=
                                        "<td>" + table.status + "</td>";
                                    tableList += "</tr>";
                                });
                            }
                        );
    
                        tableList += "</tbody></table>";
                        tablesContainer.html(tableList);
                    } else {
                        var tableList = "<table>";
                        tableList +=
                            "<thead><tr><th>Name</th><th>Min Capacity</th><th>Max Capacity</th><th>Status</th></tr></thead>";
                        tableList += "<tbody>";
    
                        $.each(data, function (index, table) {
                            tableList += "<tr>";
                            tableList += "<td>" + table.name + "</td>";
                            tableList += "<td>" + table.min_capacity + "</td>";
                            tableList += "<td>" + table.max_capacity + "</td>";
                            tableList += "<td>" + table.status + "</td>";
                            tableList += "</tr>";
                        });
    
                        tableList += "</tbody></table>";
                        tablesContainer.html(tableList);
                    }
                }
    
                // Scroll to tables container
                $('html, body').animate({
                    scrollTop: tablesContainer.offset().top
                }, 800); // Adjust duration as needed
            },
            error: function (xhr) {
                console.error("Error loading tables:", xhr.responseText);
                tablesContainer.html("<p>Error loading tables.</p>");
                loader.addClass("d-none");
            },
        });
    });
    
});
