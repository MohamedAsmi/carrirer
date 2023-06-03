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
        {
            data: "status",
            name: "status",
        },
        {
            data: "setting",
            name: "setting",
        },
        {
            data: "actions",
            name: "actions",
        },
    ];

    let table = await initDataTable($("#datatable"), columns);
});

$(document).on("click", ".delete", function () {
    $("div#message-area").html("");
    $("#delete-modal .modal-title").html("Delete User");
    $("#delete-modal #ajax-form").attr("method", "DELETE");
    $("#delete-modal #ajax-form").attr("action", $(this).attr("data-url"));
    $("#delete-modal #ajax-form").attr("data-table", "user_table");
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

$(document).on("change", "#select_setting_group", function () {
    getSettings();
});
// settingGroupOnChange();
// async function settingGroupOnChange() {

//     let response = await doAjaxPost(
//         baseURL +
//             "user-settings/" +
//             selectedParentGroup +
//             "/get-child-setting-list",
//         "post"
//     );

//     console.log(response);
// }

$(document).ready(function () {
    getSettings();
});

function getSettings() {
    let userId = $("#userId").val();
    let selectedParentGroup = $("#select_setting_group").val();
    console.log(selectedParentGroup, "val");
    let url =
        baseURL +
        "/admin/user-settings/" +
        userId +
        "/get-child-setting-list/" +
        selectedParentGroup;
    let method = "get";
    let data = { key: "value" };

    doAjaxPost(url, method, data, false)
        .then(function (response) {
            makeSettingsTable(response.data.userSettings);
        })
        .catch(function (error) {
            // Error callback
            console.error("AJAX request failed:", error);
            // Handle the error message as needed
        });
}

function makeSettingsTable(userSettings) {
    $("#settingsTable tbody").html("");
    if (!userSettings.length) {
        $("#childSettingsSection").hide();
    } else {
        $("#childSettingsSection").show();
        var tableBody = $("#settingsTable tbody");

        // Iterate over the JSON data
        $.each(userSettings, function (index, setting) {
            // Create a new table row
            var setting_value =
                setting.setting_value !== null ? setting.setting_value : "";
            var newRow = $("<tr>");
            // Create table cells for the setting name, description, and input
            var settingNameCell = $("<td>").text(setting.setting_desc);
            var settingNameCell = $("<td>").text(setting.setting_desc);
            var valueCell = $("<td>").html(
                '<input type="hidden" name="setting_id[]" value="' +
                    setting.setting_id +
                    '">' +
                    '<input type="hidden" name="setting_parent_id[]" value="' +
                    setting.setting_parent_id +
                    '">' +
                    '<input class="form-control" type="text" name="setting_val[]" value="' +
                    setting_value +
                    '" />'
            );

            // Append the cells to the row
            newRow.append(settingNameCell, valueCell);

            // Append the row to the table body
            tableBody.append(newRow);
        });
    }
}
