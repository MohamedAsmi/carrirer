$(document).ready(async function () {
    let columns = [
        {
            data: "id",
            name: "id",
        },
        {
            data: "request_file_name_user",
            name: "request_file_name_user",
        },
        {
            data: "request_file_name_generated",
            name: "request_file_name_generated",
        },
        {
            data: "no_of_items",
            name: "no_of_items",
        },
        {
            data: "total_credits",
            name: "total_credits",
        },
        {
            data: "actions",
            name: "actions", 
        },
    ];

    let table = await initDataTable($("#batch_table"), columns);
});
