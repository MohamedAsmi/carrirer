$(document).ready(async function () {
    let columns = [
        {
            data: "name",
            name: "name",
        },
        {
            data: "value",
            name: "value",
        },
        {
            data: "actions",
            name: "actions",
        },
    ];

    let table = await initDataTable($("#weightoption"), columns);
});

$(document).on("click", ".delete", function () {
    $("div#message-area").html("");
    $("#delete-modal .modal-title").html("Delete Region");
    $("#delete-modal #ajax-form").attr("method", "DELETE");
    $("#delete-modal #ajax-form").attr("action", $(this).attr("data-url"));
    $("#delete-modal #ajax-form").attr("data-table", "weightoption");
    let modal = new bootstrap.Modal(document.getElementById("delete-modal"));
    modal.show();
});
