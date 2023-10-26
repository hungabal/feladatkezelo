<!DOCTYPE html>
<html>
<head>
    <title>Csiha Teszt oldal</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="checkbox"] {
            display: block;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
        }

        .action-buttons button {
            margin-right: 10px;
        }

        .sortable-header {
            text-align: right;
        }
    </style>
</head>
<body>
<div class="action-buttons">
    <button class="btn btn-danger delete-button" id="deleteButton" disabled><i class="fas fa-trash"></i> Töröl</button>
    <button class="btn btn-success status-button" id="statusButton" disabled><i class="fas fa-check"></i> Státusz
    </button>
    <button class="btn btn-primary add-task-button" id="addTaskButton"><i class="fas fa-plus"></i> Új feladat</button>
    <button class="btn btn-warning edit-row-button" id="editRowButton" disabled><i class="fas fa-edit"></i> Sor
        szerkesztés
    </button>
</div>
<input type="text" id="searchInput" placeholder="Szűrés...">
<table id="myTable">
    <thead>
    <tr>
        <th></th>
        <th class="sortable-header">Feladat azon. <i class="fas fa-sort"></i></th>
        <th class="sortable-header">Feladat leírás <i class="fas fa-sort"></i></th>
        <th class="sortable-header">Név <i class="fas fa-sort"></i></th>
        <th class="sortable-header">Email <i class="fas fa-sort"></i></th>
        <th class="sortable-header">Becsült idő <i class="fas fa-sort"></i></th>
        <th class="sortable-header">Felhasznált idő <i class="fas fa-sort"></i></th>
        <th class="sortable-header">Készítének dátuma <i class="fas fa-sort"></i></th>
        <th class="sortable-header">Elkészülés ideje <i class="fas fa-sort"></i></th>
    </tr>
    </thead>
    <tbody id="adatok">
    </tbody>
</table>

<p id="becsult">Becsült összesen: 0:0:0</p>
<p id="felhasznalt">Felhasznált összesen: 0:0:0</p>

<!-- Törlés modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Törlés megerősítése</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Biztosan törölni szeretné ezt az elemet?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Mégse</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Törlés</button>
            </div>
        </div>
    </div>
</div>

<!-- Új feladat modal -->
<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaskModalLabel">Új feladat hozzáadása</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addTaskForm">
                    <div class="form-group">
                        <label for="taskDescription">Feladat leírás</label>
                        <input type="text" class="form-control" id="taskDescription" placeholder="Feladat leírás">
                    </div>
                    <div class="form-group">
                        <label for="taskUserName">Név</label>
                        <select class="form-control" id="taskUserName"></select>
                    </div>
                    <div class="form-group">
                        <label for="taskCalcTime">Becsült idő</label>
                        <input type="time" class="form-control" id="taskCalcTime" placeholder="Becsült idő">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Mégse</button>
                <button type="button" class="btn btn-primary" id="saveTask">Mentés</button>
            </div>
        </div>
    </div>
</div>

<!-- Sor szerkesztés modal -->
<div class="modal fade" id="editRowModal" tabindex="-1" role="dialog" aria-labelledby="editRowModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRowModalLabel">Sor szerkesztése</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editRowForm">
                    <div class="form-group">
                        <label for="editTaskDescription">Feladat leírás</label>
                        <input type="text" class="form-control" id="editTaskDescription" placeholder="Feladat leírás">
                    </div>
                    <div class="form-group">
                        <label for="editTaskUserName">Név</label>
                        <select class="form-control" id="editTaskUserName"></select>
                    </div>
                    <div class="form-group">
                        <label for="editTaskCalcTime">Becsült idő</label>
                        <input type="time" class="form-control" id="editTaskCalcTime" placeholder="Becsült idő">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Mégse</button>
                <button type="button" class="btn btn-primary" id="saveEditedRow">Mentés</button>
            </div>
        </div>
    </div>
</div>

<!-- Státusz modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Státusz módosítása</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Válassza ki az új státuszt:</p>
                <select id="statusSelect" class="form-control">
                    <option value="Kesz">Kész</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Mégse</button>
                <button type="button" class="btn btn-success" id="confirmStatus">Mentés</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        //Oldal betöltésével adatok lekérdezése
        $.ajax({
            url: "/api/task/list",
            dataType: "json",
            type: "get",
            data: {},
            success: function (result) {
                if (result.length > 0) {
                    var html = "";
                    result.forEach((task) => {
                        html += "<tr>";
                        html += "<td><input type='checkbox'></td>";
                        html += "<td>" + task.ta_id + "</td>";
                        html += "<td>" + task.ta_description + "</td>";
                        html += "<td>" + task.us_name + "</td>";
                        html += "<td>" + task.us_email + "</td>";
                        html += "<td>" + task.ta_estimatedtime + "</td>";
                        if (task.ta_usedtime == null) {
                            html += "<td></td>";
                        } else {
                            html += "<td>" + task.ta_usedtime + "</td>";
                        }
                        html += "<td>" + task.ta_createdat + "</td>";
                        if (task.ta_completedat == null) {
                            html += "<td></td>";
                        } else {
                            html += "<td>" + task.ta_completedat + "</td>";
                        }
                        html += "</tr>";
                    });
                    $("#adatok").html(html);
                }

                // Checkbox kiválasztás figyelése
                $("input[type=checkbox]").change(function () {
                    var checked = $("input[type=checkbox]:checked");
                    selectedRows = checked.closest("tr");
                    $("#deleteButton, #editRowButton, #statusButton").prop("disabled", checked.length === 0);

                    // Összegzés becsült idő és felhasznált idő alapján
                    var totalEstimatedTime = [0, 0, 0]; // [óra, perc, másodperc]
                    var totalUsedTime = [0, 0, 0]; // [óra, perc, másodperc]

                    selectedRows.each(function () {
                        var selectedRow = $(this).first();
                        var columns = selectedRow.find("td");
                        var estimatedTime = columns.eq(5).text(); // Becsült idő oszlop
                        var usedTime = columns.eq(6).text(); // Felhasznált idő oszlop

                        if (estimatedTime) {
                            var estimatedTimeParts = estimatedTime.split(":");
                            totalEstimatedTime[0] += parseInt(estimatedTimeParts[0]); // óra
                            totalEstimatedTime[1] += parseInt(estimatedTimeParts[1]); // perc
                            totalEstimatedTime[2] += parseInt(estimatedTimeParts[2]); // másodperc
                        }

                        if (usedTime) {
                            var usedTimeParts = usedTime.split(":");
                            totalUsedTime[0] += parseInt(usedTimeParts[0]); // óra
                            totalUsedTime[1] += parseInt(usedTimeParts[1]); // perc
                            totalUsedTime[2] += parseInt(usedTimeParts[2]); // másodperc
                        }
                    });

                    // időtúllépést (például 60 perc = 1 óra)
                    totalEstimatedTime[1] += Math.floor(totalEstimatedTime[2] / 60);
                    totalEstimatedTime[0] += Math.floor(totalEstimatedTime[1] / 60);
                    totalEstimatedTime[1] %= 60;
                    totalEstimatedTime[2] %= 60;

                    totalUsedTime[1] += Math.floor(totalUsedTime[2] / 60);
                    totalUsedTime[0] += Math.floor(totalUsedTime[1] / 60);
                    totalUsedTime[1] %= 60;
                    totalUsedTime[2] %= 60;

                    $("#becsult").html("Becsült összesen: "+totalEstimatedTime[0] + ":" + totalEstimatedTime[1] + ":" + totalEstimatedTime[2]);
                    $("#felhasznalt").html("Felhasznált összesen: "+totalUsedTime[0] + ":" + totalUsedTime[1] + ":" + totalUsedTime[2]);
                });
            },
            error: function (jqXHR, testStatus, error) {
                console.log(error);
            },
            timeout: 8000
        });

        var selectedRows = $();

        // Szűrési funkció
        $("#searchInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#myTable tbody tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        // Sorba rendezés funkció
        $("th").click(function () {
            var index = $(this).index();
            var isAscending = true;
            var rows = $("#myTable tbody tr").get();

            rows.sort(function (a, b) {
                var A = $(a).children("td").eq(index).text().toUpperCase();
                var B = $(b).children("td").eq(index).text().toUpperCase();

                if (A < B) {
                    return -1;
                }
                if (A > B) {
                    return 1;
                }

                return 0;
            });

            if ($(this).hasClass("sorted-asc")) {
                rows.reverse();
                isAscending = false;
            }

            $("#myTable tbody").empty().append(rows);

            $("th").removeClass("sorted-asc sorted-desc");
            if (isAscending) {
                $(this).addClass("sorted-asc");
            } else {
                $(this).addClass("sorted-desc");
            }
        });

        // Új feladat modal megjelenítése
        $("#addTaskButton").click(function () {
            $("#addTaskModal").modal("show");

            $.ajax({
                url: "/api/user/list",
                dataType: "json",
                type: "get",
                data: {},
                success: function (result) {
                    if (result.length > 0) {
                        result.forEach((user) => {
                            $('#taskUserName').append($('<option>', {
                                value: user.us_id,
                                text: user.us_name
                            }));
                        });
                    } else {
                        alert(result.text);
                    }
                },
                error: function (jqXHR, testStatus, error) {
                    console.log(error);
                },
                timeout: 8000
            });
        });

        // Új feladat mentése gombra kattintva
        $("#saveTask").click(function () {
            var taskDescription = $("#taskDescription").val();
            var taskUserName = $("#taskUserName").val();
            var taskCalcTime = $("#taskCalcTime").val();

            // Ellenőrizd, hogy a szükséges mezők ki vannak-e töltve
            if (taskDescription && taskUserName && taskCalcTime) {
                // Új sor hozzáadása a táblázathoz
                var newRow = "<tr>" +
                    "<td><input type='checkbox'></td>" +
                    "<td>0</td>" +
                    "<td>" + taskDescription + "</td>" +
                    "<td>" + taskUserName + "</td>" +
                    "<td>" + taskCalcTime + "</td>" +
                    "<td></td>" +
                    "<td></td>" +
                    "<td></td>" +
                    "</tr>";
                $("#myTable tbody").append(newRow);

                // Modal ablak bezárása
                $("#addTaskModal").modal("hide");

                // Töröld az űrlap mezők tartalmát
                $("#addTaskForm")[0].reset();

                $.ajax({
                    url: "/api/task/create",
                    dataType: "json",
                    type: "post",
                    data: {
                        taskDescription: taskDescription,
                        taskUserName: taskUserName,
                        taskCalcTime: taskCalcTime
                    },
                    success: function (result) {
                        if (result.error == 0) {
                            window.location.reload();
                        } else {
                            alert(result.text);
                        }
                    },
                    error: function (jqXHR, testStatus, error) {
                        console.log(error);
                    },
                    timeout: 8000
                });
            }
        });

        // Törlés modal megjelenítése
        $("#deleteButton").click(function () {
            $("#deleteModal").modal("show");
        });

        // Törlés gombra kattintva
        $("#confirmDelete").click(function () {
            // Megerősített törlés
            selectedRows.each(function () {
                var selectedRow = $(this).first();
                var columns = selectedRow.find("td");
                $.ajax({
                    url: "/api/task/delete",
                    dataType: "json",
                    type: "delete",
                    data: {
                        taskId: columns.eq(1).text(),
                    },
                    success: function (result) {
                        if (result.error == 0) {
                            window.location.reload();
                        } else {
                            alert(result.text);
                        }
                    },
                    error: function (jqXHR, testStatus, error) {
                        console.log(error);
                    },
                    timeout: 8000
                });
            });
            selectedRows = $();
            $("#deleteModal").modal("hide");
        });

        // Státusz modal megjelenítése
        $("#statusButton").click(function () {
            $("#statusModal").modal("show");
        });

        // Státusz mentése gombra kattintva
        $("#confirmStatus").click(function () {
            var selectedStatus = $("#statusSelect").val();

            // Kiválasztott sorok stílusának beállítása
            selectedRows.each(function () {
                var selectedRow = $(this).first();
                var columns = selectedRow.find("td");
                $.ajax({
                    url: "/api/task/status",
                    dataType: "json",
                    type: "post",
                    data: {
                        taskId: columns.eq(1).text(),
                        selectedStatus: selectedStatus
                    },
                    success: function (result) {
                        if (result.error == 0) {
                            window.location.reload();
                        } else {
                            alert(result.text);
                        }
                    },
                    error: function (jqXHR, testStatus, error) {
                        console.log(error);
                    },
                    timeout: 8000
                });
            });
            selectedRows = $();

            // Modal bezárása
            $("#statusModal").modal("hide");
        });

        // Sor szerkesztése gombra kattintva
        $("#editRowButton").click(function () {
            // Ellenőrizd, hogy csak egy sor van kiválasztva
            if (selectedRows.length === 1) {
                var selectedRow = selectedRows.first();
                var columns = selectedRow.find("td");

                // Az adatok betöltése a modalba
                $("#editTaskDescription").val(columns.eq(2).text());
                $("#editTaskUserName").val(columns.eq(3).text());
                $("#editTaskCalcTime").val(columns.eq(5).text());

                $("#editRowModal").modal("show");

                $.ajax({
                    url: "/api/user/list",
                    dataType: "json",
                    type: "get",
                    data: {},
                    success: function (result) {
                        if (result.length > 0) {
                            result.forEach((user) => {
                                $('#editTaskUserName').append($('<option>', {
                                    value: user.us_id,
                                    text: user.us_name
                                }));
                            });
                            $('#editTaskUserName option[value="' + columns.eq(3).text() + '"]').attr('selected', 'selected');
                        } else {
                            alert(result.text);
                        }
                    },
                    error: function (jqXHR, testStatus, error) {
                        console.log(error);
                    },
                    timeout: 8000
                });
            }
        });

        // Sor szerkesztése modal mentés gombra kattintva
        $("#saveEditedRow").click(function () {
            // Ellenőrizd, hogy csak egy sor van kiválasztva
            if (selectedRows.length === 1) {
                var selectedRow = selectedRows.first();
                var columns = selectedRow.find("td");

                // Adatok frissítése a modalban megadott értékekkel
                columns.eq(2).text($("#editTaskDescription").val());
                columns.eq(3).text($("#editTaskUserName").val());
                columns.eq(5).text($("#editTaskCalcTime").val());

                // Modal ablak bezárása
                $("#editRowModal").modal("hide");

                $.ajax({
                    url: "/api/task/edit",
                    dataType: "json",
                    type: "put",
                    data: {
                        taskId: columns.eq(1).text(),
                        editTaskDescription: $("#editTaskDescription").val(),
                        editTaskUserName: $("#editTaskUserName").val(),
                        editTaskCalcTime: $("#editTaskCalcTime").val()
                    },
                    success: function (result) {
                        if (result.error == 0) {
                            window.location.reload();
                        } else {
                            alert(result.text);
                        }
                    },
                    error: function (jqXHR, testStatus, error) {
                        console.log(error);
                    },
                    timeout: 8000
                });
            }
        });
    });
</script>
</body>
</html>
