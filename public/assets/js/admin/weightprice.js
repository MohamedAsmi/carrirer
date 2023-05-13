$(document).ready(async function () {
    let columns = [
        {
            data: "id",
            name: "id",
        },
        {
            data: "region",
            name: "region",
        },
        {
            data: "weightoption",
            name: "weightoption",
        },
        {
            data: "credits",
            name: "credits",
        },
        {
            data: "actions",
            name: "actions",
        },
    ];

    let table = await initDataTable($("#weightprice"), columns);
});

$(document).on("click", ".delete", function () {
    $("div#message-area").html("");
    $("#delete-modal .modal-title").html("Delete Region");
    $("#delete-modal #ajax-form").attr("method", "DELETE");
    $("#delete-modal #ajax-form").attr("action", $(this).attr("data-url"));
    $("#delete-modal #ajax-form").attr("data-table", "weightprice");
    let modal = new bootstrap.Modal(document.getElementById("delete-modal"));
    modal.show();
});

