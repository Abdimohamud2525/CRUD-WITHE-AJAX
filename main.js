$(document).ready(function() {
    $('#AddNew').click(function() {
        $('#studentModal').modal('show');
    });

    // Call loadingData function when the document is ready
    loadingData();

    $("#studentForm").submit(function(event) {
        event.preventDefault();

        let form_data = new FormData($("#studentForm")[0]);
        form_data.append("action", "Register");

        $.ajax({
            method: "POST",
            dataType: "JSON",
            url: "api.php",
            data: form_data,
            processData: false,
            contentType: false,
            success: function(data) {
                let response = data.data;
                $("#studentForm")[0].reset();
                alert(response);
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

    function loadingData() {
        let sendingData = {
            "action": "readAll"
        };

        $.ajax({
            method: "POST",
            dataType: "JSON",
            url: "api.php",
            data: sendingData,
            success: function(data) {
                let response = data.data;
                let tr = "";

                if (data.status) {
                    response.forEach(item => {
                        tr += "<tr>";
                        for (let key in item) {
                            tr += `<td>${item[key]}</td>`;
                        }
                        tr += `<td><a href="#" class="btn btn-info update_info" data-update_id="${item["id"]}"><i class="fa-solid fa-pen"></i></a></td><td><a href="#" class="btn btn-danger delete_info" data-delete_id="${item["id"]}"><i class="fa-solid fa-trash"></i></a></td></tr>`;
                    });
                    $("#studentTable tbody").html(tr);
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function delet(id) {
        let sendingData = {
            "action": "delete",
            "id": id
        };

        $.ajax({
            method: "POST",
            dataType: "JSON",
            url: "api.php",
            data: sendingData,
            success: function(data) {
                if (data.status) {
                    alert(data.data); // Näytä vastauksen viesti
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function update(id) {
        let sendingData = {
            "action": "update",
            "id": id
        };

        $.ajax({
            method: "POST",
            dataType: "JSON",
            url: "api.php",
            data: sendingData,
            success: function(data) {
                if (data.status) {
                    alert(data.data); // Näytä vastauksen viesti
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    // Käytetään tapahtumavalvontaa dynaamisesti luoduille elementeille
    $("#studentTable").on("click", ".delete_info", function() {
        let id = $(this).data("delete_id"); // Hae id data-attribuutista

        if(confirm("Oletko varma että haluat poista?"))
        // Kutsu delet-funktiota annetulla id:llä
        delet(id);
    });

    $("#studentTable").on("click", ".update_info", function() {
        let id = $(this).data("update_id"); // Hae id data-attribuutista

        // Kutsu update-funktiota annetulla id:llä
        update(id);
    });
});
