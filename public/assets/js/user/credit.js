$(document).ready(async function () {
    var formId = $("#credits_table").attr('formId');
    let columns = [
        {
            data: "id",
            name: "id",
        },
        {
            data: "credit_added",
            name: "credit_added",
        },
        {
            data: "credit_amount",
            name: "credit_amount",
        },
        {
            data: "total",
            name: "total",
        },
        {
            data: "source",
            name: "source",
        },
        {
            data: "details",
            name: "details",
        },
    ];

    let table = await initDataTable($("#credits_table"), columns,formId);
});
