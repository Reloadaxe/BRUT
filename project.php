<?php

include_once(__DIR__ . "/navbar.php");
$name = $_GET["name"];

$testsFiles = glob(__DIR__ . "/projects/" . $name . "/tests/*Test.php");

?>

<style>

.v-hr{ 
  border:         none;
  border-left:    1px solid hsla(200, 10%, 50%,100);
  height:         100vh;
  width:          1px;       
}

</style>

<script>
    var editor = [];
</script>

<div style="margin-top: 20px;text-align: center;">
    <div class="row">
        <div class="col-3">
            <button id="launchTest" class="btn btn-success form-control">Lancer les tests</button>
            <hr/>
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <?php foreach ($testsFiles as $num => $testsFile) : ?>
                <div class="row">
                    <div class="col-<?php echo ($num == 0 ? "8" : "12"); ?>">
                        <button class="nav-link tabsList fileName<?php echo ($num == 0 ? " active" : ""); ?>" style="width: 100%;" data-for="#file<?php echo $num ?>"><?php echo basename($testsFile) ?></button>
                    </div>
                    <div class="actions col-2"<?php echo ($num == 0 ? "" : " hidden"); ?>>
                        <button class="nav-link btn-success save" data-filepath="<?php echo $testsFile ?>" data-contentid="<?php echo $num ?>"><i class="fa fa-save"></i></button>
                    </div>
                    <div class="actions col-2"<?php echo ($num == 0 ? "" : " hidden"); ?>>
                        <button class="nav-link btn-danger delete" data-filepath="<?php echo $testsFile ?>"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <?php endforeach; ?>
                <button class="nav-link tabsList<?php echo (count($testsFiles) == 0 ? " active" : ""); ?>" data-for="#addFile">Ajouter un fichier de tests</button>
            </div>
        </div>
        <div class="col-1">
            <hr class="v-hr"/>
        </div>
        <div class="col-8">
            <div class="tab-content" id="v-pills-tabContent">
                <?php foreach ($testsFiles as $num => $testsFile) : ?>
                    <div class="tab-pane fade<?php echo ($num == 0 ? " show active" : ""); ?>" id="file<?php echo $num ?>">
                        <div class="container">
                            <div id="function<?php echo $num ?>" class="editor"><?php echo trim(str_replace(["<?php", "?>"], "", file_get_contents($testsFile))) ?></div>
                            <script>
                                editor[<?php echo $num ?>] = ace.edit("function<?php echo $num ?>");
                            </script>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="tab-pane fade<?php echo (count($testsFiles) == 0 ? " show active" : ""); ?>" id="addFile">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <span id="error" style="color: red;"></span>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Nom du fichier :</label>
                            </div>
                            <div class="col-lg-8">
                                <input class="form-control" id="fileName" placeholder="Exemple" />
                            </div>
                            <div class="col-lg-4">
                                <input class="form-control" placeholder="Test.php" disabled />
                            </div>
                            <div class="col-lg-12" style="margin-top: 20px;">
                                <button class="btn btn-success" id="addFileButton">Ajouter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

$(".tabsList").on("click", function() {
    $(".tabsList").removeClass("active");
    $(".tab-pane").removeClass("show");
    $(".tab-pane").removeClass("active");
    $(this).addClass("active");
    $($(this).data("for")).addClass("show");
    $($(this).data("for")).addClass("active");
    let parent = $(".fileName").parent();
    parent.removeClass("col-8");
    parent.addClass("col-12");
    let actions = parent.parent().find(".actions");
    actions.prop("hidden", true);
    if ($(this).hasClass("fileName")) {
        let div = $(this).parent();
        div.removeClass("col-12");
        div.addClass("col-8");
        div.parent().find(".actions").prop("hidden", false);
    }
});

$("#addFileButton").on("click", function() {
    if ($("#fileName").val() == "") {
        $("#error").text("Veuillez rentrer un nom de fichier");
        return;
    }
    $.ajax("/addFile.php", {
        method: "POST",
        data: {projectName: "<?php echo $name ?>", fileName: $("#fileName").val() + "Test.php"}
    })
    .done(function(data) {
        if (data != "") {
            $("#error").text(data);
            return;
        }
        window.location.reload(true);
    });
});

$(".save").on("click", function() {
    let filepath = $(this).data("filepath");
    let contentId = $(this).data("contentid");
    var content = editor[contentId].getValue();
    $.ajax("/saveTestFile.php", {
        method: "POST",
        data: {content: content, filePath: filepath}
    }).done(function() {
        alert("fichier sauvegardé");
    });
});

$(".delete").on("click", function() {
    let filepath = $(this).data("filepath");
    $.ajax("/deleteTestFile.php", {
        method: "POST",
        data: {filePath: filepath}
    }).done(function() {
        window.location.reload(true);
    });
});

$("#launchTest").on("click", function() {
    $.ajax("/doTests.php", {
        method: "POST",
        data: {projectName: "<?php echo $name ?>"}
    }).done(function(data) {
        window.open(data, "_blank");
    });
})

</script>