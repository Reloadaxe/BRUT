<?php

include_once(__DIR__ . "/navbar.php");

$projects = [];

foreach (glob(dirname(dirname(__DIR__)) . '/projects/*', GLOB_ONLYDIR) as $dir) {
    $projects[] = basename($dir);
};

?>

<div class="container" style="margin-top: 20px;text-align: center;">
    <div class="row">
        <?php foreach ($projects as $project) : ?>
            <button class="btn btn-primary project" style="margin: 10px;"><?php echo $project ?></button>
        <?php endforeach; ?>
    </div>
</div>

<script>

    $(".project").on("click", function() {
        window.location = "/web/project/project.php?name=" + $(this).text();
    });

</script>