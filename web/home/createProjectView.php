<?php

include_once(__DIR__ . "/navbar.php");

?>

<div class="container" style="margin-top: 20px;text-align: center;">
    <div class="row">
        <div class="col-lg-12" style="color: red;">
            <span id="error"></span>
        </div>
        <div class="col-lg-12">
            <label>Nom du projet :</label>
        </div>
        <div class="col-lg-12">
            <input class="form-control" type="text" id="projectName" required />
        </div>
        <div class="col-lg-12">
            <label>Dossier contenant les fichiers à tester ( chemin complet ) :</label>
        </div>
        <div class="col-lg-12">
            <input class="form-control typeahead" type="text" id="toTestFolder" data-spanid="#spanTypeahead1" placeholder="/chemin/vers/dossier/" required />
        </div>
        <div class="col-lg-12" style="text-align: left;">
            <span id="spanTypeahead1"></span>
        </div>
        <div class="col-lg-12" style="margin-top: 20px;">
            <button class="btn btn-success" id="submit">Créer un nouveau projet</button>
        </div>
    </div>
</div>

<script>

$(".typeahead").on("input", function() {
    var spanId = $(this).data("spanid");
    $.ajax("/web/home/getFolder.php", {
        method: "POST",
        data: {folderBeginWith: $(this).val()}
    })
    .done(function(data) {
        $(spanId).text(data);
    });
});

$("#submit").on("click", function() {
    var testFolder = $("#testFolder").val();
    var toTestFolder = $("#toTestFolder").val();
    var name = $("#projectName").val();
    if (testFolder == "" || toTestFolder == "" || name == "") {
        $("#error").text("Veuillez remplir tous les champs");
        return;
    }
    $.ajax("/web/home/createProject.php", {
        method: "POST",
        data: {testFolder: testFolder, toTestFolder: toTestFolder, name: name}
    })
    .done(function(data) {
        if (data != "") {
            $("#error").text(data);
            return;
        }
        window.location = "/";
    });
});

</script>