<?php
global $project;
global $SQL;

$Project = $SQL->Select('name', 'projects', '1', 'OBJECT');
$Project->slug = $project;
?><!DOCTYPE html>
<html lang="en">
    <head>
        <?php require __DIR__ . '/../vendors.inc'; ?>

        <title>Reports - Feedback</title>
    </head>
    <body>
        <?php require __DIR__ . '/../navigation.inc'; ?>

        <header class="py-16">
            <h1 class="text-6xl w-full text-center font-bold"><?php echo $Project->name; ?></h1>
            <p class="text-3xl w-full text-center">Feedback</p>
        </header>

        <main class="pb-16 lg:px-32 md:px-20 sm:px-12 px-4 text-center">
            <a href="<?php echo $Project->slug; ?>/suggestions" class="text-3xl font-bold underline">View Suggestions</a><br>
            <br><br><br><br>
            <a href="<?php echo $Project->slug; ?>/reports" class="text-3xl font-bold mt-16 underline">View Reports</a>
        </main>
    </body>
</html>