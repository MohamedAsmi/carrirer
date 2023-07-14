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

$(document).on("click", "#syncBtn", function (e) {
    e.preventDefault();
    let url = $(this).data("url");
    doAjaxPost(url, "get").then(function (data) {
        if (data.result == "success") {
            toastr["success"](data.message);
        } else {
            toastr["error"](data.message);
        }

        setTimeout(function () {
            location.reload();
        }, 3000);
    });
});
