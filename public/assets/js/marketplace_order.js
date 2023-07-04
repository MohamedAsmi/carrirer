$(document).ready(async function () {
    let columns = [
        {
            data: "mp_order_id",
        },
        {
            data: "marketplace",
        },
        {
            data: "products",
        },
        {
            data: "actions",
        },
    ];

    let table = await initDataTable($("#marketplace_order"), columns);
});

$(document).on("click", ".delete", function () {
    $("div#message-area").html("");
    $("#delete-modal .modal-title").html("Delete Region");
    $("#delete-modal #ajax-form").attr("method", "DELETE");
    $("#delete-modal #ajax-form").attr("action", $(this).attr("data-url"));
    $("#delete-modal #ajax-form").attr("data-table", "datatable");
    let modal = new bootstrap.Modal(document.getElementById("delete-modal"));
    modal.show();
});
