$(document).ready(async function () {
    let columns = [
        {
            data: "id",
            name: "id",
        },
        {
            data: "name",
            name: "name",
        },
        
    ];

    let table = await initDataTable($("#source_table"), columns);
});