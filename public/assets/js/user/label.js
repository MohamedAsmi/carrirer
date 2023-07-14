$(document).ready(async function () {
    let columns = [
        {
            data: "id",
            name: "id",
        },
        {
            data: "title",
            name: "title",
        },
        {
            data: "name",
            name: "name",
        },
        {
            data: "mobile",
            name: "mobile", 
        },
        {
            data: "email",
            name: "email",
        },
        {
            data: "refrence",
            name: "refrence",
        },
        {
            data: "address1",
            name: "address1", 
        },
        {
            data: "street",
            name: "street",
        },
        {
            data: "postcode",
            name: "postcode",
        },
        {
            data: "city",
            name: "city", 
        },
        {
            data: "actions",
            name: "actions", 
        },
    ];

    let table = await initDataTable($("#labels_table"), columns);
});


$(document).on("click", ".delete", function () {
    $("div#message-area").html("");
    $("#delete-modal .modal-title").html("Delete Region");
    $("#delete-modal #ajax-form").attr("method", "DELETE");
    $("#delete-modal #ajax-form").attr("action", $(this).attr("data-url"));
    $("#delete-modal #ajax-form").attr("data-table", "labels_table");
    let modal = new bootstrap.Modal(document.getElementById("delete-modal"));
    modal.show();
});