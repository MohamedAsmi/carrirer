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
            data: "credit_balance",
            name: "credit_balance",
        },
        {
            data: "source",
            name: "source",
        },
        {
            data: "details",
            name: "details",
        },
        {
            data: "actions",
            name: "actions", 
        },
    ];

    let table = await initDataTable($("#credits_table"), columns);
});
