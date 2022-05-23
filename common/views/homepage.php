<?php
global $SQL;
$Projects = $SQL->Select('`slug`, `name`, `image`', 'projects', '`visible` = 1', 'ALL:ASSOC');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <?php require __DIR__ . '/../vendors.inc'; ?>

        <title>Find Server Information - Feedback</title>
    </head>
    <body>
        <?php require __DIR__ . '/../navigation.inc'; ?>

        <header class="py-16">
            <h1 class="text-6xl w-full text-center font-bold">Software Feedback</h1>
            <p class="text-3xl w-full text-center">Let us know how we're doing.</p>
        </header>

        <main class="pb-16 lg:px-32 md:px-20 sm:px-12 px-4 text-center">
            <h2 class="text-2xl font-bold mb-2">Submit Feedback</h2>
            <div class="grid grid-cols-2 lg:gap-8 md:gap-6 gap-4 max-w-5xl mx-auto">
                <a href="software-feedback" class="shadow-lg hover:shadow-xl bg-neutral-100 hover:bg-neutral-50 rounded-md px-2 py-2 transition duration-200">
                    <strong class="text-xl">Software</strong><br>
                    Boa, Bonfire, Pixelset, and Saturn.
                </a>
                <a href="website-feedback" class="shadow-lg hover:shadow-xl bg-neutral-100 hover:bg-neutral-50 rounded-md px-2 py-2 transition duration-200">
                    <strong class="text-xl">Websites</strong><br>
                    GeolHistory, LewMC and WhatAccomm.
                </a>
            </div>
            <br><br>
            <h2 class="text-2xl font-bold mb-2">View Feedback</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:gap-8 md:gap-6 gap-4 max-w-5xl mx-auto">
                <?php foreach($Projects as $Project) { ?>
                <div class="shadow-lg bg-neutral-100 rounded-md px-2 py-2 transition">
                    <div class="flex space-x-2 mx-auto mb-2">
                        <span class="flex-grow">&nbsp;</span>
                        <img src="<?php echo $Project['image']; ?>" class="h-6 w-6 self-center" alt="<?php echo $Project['name']; ?>">
                        <strong class="text-xl self-center"><?php echo $Project['name']; ?></strong>
                        <span class="flex-grow">&nbsp;</span>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <a href="<?php echo $Project['slug']; ?>/suggestions" class="bg-neutral-50 hover:bg-white px-2 py-2 transition duration-200 rounded-md">Suggestions</a>
                        <a href="<?php echo $Project['slug']; ?>/reports" class="bg-neutral-50 hover:bg-white px-2 py-2 transition duration-200 rounded-md">Reports</a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </main>
    </body>
</html>