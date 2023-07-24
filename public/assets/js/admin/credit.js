$(document).ready(async function () {
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
            data: "source",
            name: "source",
        },
        {
            data: "addby",
            name: "addby",
        },
        {
            data: "addto",
            name: "addto",
        },
        {
            data: "details",
            name: "details",
        },
    ];

    let table = await initDataTable($("#credits_table"), columns);
});
