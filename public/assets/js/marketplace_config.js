$(document).ready(async function () {
    let columns = [
        {
            data: "name",
            name: "name",
        },
        {
            data: "config",
            name: "config",
        },
        {
            data: "actions",
            name: "actions",
        },
    ];

    let table = await initDataTable($("#marketplace_config"), columns);
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
