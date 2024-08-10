$(".view-tables-btn").click(function () {
    var $button = $(this);
    var $spinner = $button.find(".spinner-border");
    var restaurantId = $button.data("id");
    var viewType = $button.data("type");
    var tablesContainer = $(".tables-container");
    var loader = $("#tables-loader");

    $spinner.removeClass("d-none");
    loader.removeClass("d-none");

    $.ajax({
        url: "/restaurants/" + restaurantId + "/tables",
        method: "GET",
        data: {
            type: viewType,
        },
        success: function (data) {
            tablesContainer.empty();
            loader.addClass("d-none");
            $spinner.addClass("d-none");

            if (data.length === 0) {
                tablesContainer.html("<p>No tables available.</p>");
            } else {
                var tableList = "<table>";
                tableList +=
                    "<thead><tr><th>Name</th><th>Min Capacity</th><th>Max Capacity</th><th>Status</th></tr></thead>";
                tableList += "<tbody>";

                if (viewType === "active") {
                    var groupedTables = {};
                    $.each(data, function (index, table) {
                        if (!groupedTables[table.dining_area]) {
                            groupedTables[table.dining_area] = [];
                        }
                        groupedTables[table.dining_area].push(table);
                    });

                    $.each(groupedTables, function (diningAreaName, tables) {
                        tableList +=
                            "<tr class='group-name'><td colspan='4'><strong>" +
                            diningAreaName +
                            "</strong></td></tr>";

                        $.each(tables, function (index, table) {
                            tableList += "<tr>";
                            tableList += "<td>" + table.name + "</td>";
                            tableList += "<td>" + table.min_capacity + "</td>";
                            tableList += "<td>" + table.max_capacity + "</td>";
                            tableList += "<td>" + table.status + "</td>";
                            tableList += "</tr>";
                        });
                    });
                } else {
                    $.each(data, function (index, table) {
                        tableList += "<tr>";
                        tableList += "<td>" + table.name + "</td>";
                        tableList += "<td>" + table.min_capacity + "</td>";
                        tableList += "<td>" + table.max_capacity + "</td>";
                        tableList += "<td>" + table.status + "</td>";
                        tableList += "</tr>";
                    });
                }

                tableList += "</tbody></table>";
                tablesContainer.html(tableList);
            }

            $("html, body").animate(
                {
                    scrollTop: tablesContainer.offset().top,
                },
                800
            );
        },
        error: function (xhr) {
            console.error("Error loading tables:", xhr.responseText);
            tablesContainer.html("<p>Error loading tables.</p>");
            loader.addClass("d-none");
            $spinner.addClass("d-none");
        },
    });
});
document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".view-tables-btn");

    buttons.forEach((button) => {
        button.addEventListener("click", function () {
            buttons.forEach((btn) => btn.classList.remove("active-button"));
            this.classList.add("active-button");
        });
    });
});
