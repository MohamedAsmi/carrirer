$(document).ready(async function () {
    let columns = [
        {
            data: "id",
            name: "id",
        },
        {
            data: "code",
            name: "code",
        },
        {
            data: "name",
            name: "name",
        },
        {
            data: "description",
            name: "description",
        },
        {
            data: "actions",
            name: "actions",
        },
    ];

    let table = await initDataTable($("#region_table"), columns);
});

$(document).on("click", ".delete", function () {
    $("div#message-area").html("");
    $("#delete-modal .modal-title").html("Delete Region");
    $("#delete-modal #ajax-form").attr("method", "DELETE");
    $("#delete-modal #ajax-form").attr("action", $(this).attr("data-url"));
    $("#delete-modal #ajax-form").attr("data-table", "region_table");
    let modal = new bootstrap.Modal(document.getElementById("delete-modal"));
    modal.show();
});

$(document).on("change", "#role_id", async function () {
    var role_id = $(this).val();
    if (role_id == 3) {
        $(".addmission").html(
            '<div class="row mb-3"><label for="name" class="col-md-4 col-form-label text-md-end">Addmission Number</label><div class="col-md-6"><input id="addmission_number" type="text" class="form-control" name="addmission_number" value="" required autocomplete="addmission_number" autofocus></div></div>'
        );
    } else {
        $(".addmission").empty();
    }
});
