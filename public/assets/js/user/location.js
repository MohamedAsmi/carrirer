$(document).ready(async function () {
    let columns = [
        {
            data: "id",
            name: "id",
        },
        {
            data: "date",
            name: "date",
        },
        {
            data: "status",
            name: "status",
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

    let table = await initDataTable($("#locations_table"), columns);
});
