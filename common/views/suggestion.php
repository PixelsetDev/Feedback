<?php
global $SQL;
global $Projects;

$id = $SQL->Escape(basename($_SERVER['REQUEST_URI']));

foreach($Projects as $Project) {
    if (str_contains($_SERVER['REQUEST_URI'], $Project[0])) {
        $project = $Project[0];
    }
}

$Suggestion = $SQL->Select('*', 'suggestions', '`id` = \''.$id.'\'', 'OBJECT');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <?php require __DIR__ . '/../vendors.inc'; ?>

        <title>Suggestion #<?php echo $id; ?> - <?php echo ucfirst($project); ?> Reports - Feedback</title>
    </head>
    <body>
        <?php require __DIR__ . '/../navigation.inc'; ?>

        <header class="py-16">
            <h1 class="text-6xl w-full text-center font-bold"><?php echo ucfirst($project); ?> Reports</h1>
            <p class="text-3xl w-full text-center">Suggestion #<?php echo $id; ?></p>
        </header>

        <main class="pb-16 lg:px-32 md:px-20 sm:px-12 px-4 text-center">
            <?php if ($Suggestion->status == 'REJECTED') { ?>
                <div class="mb-4 border-l-2 border-red-500 bg-red-100 w-full lg:w-2/3 py-1 text-center mx-auto">
                    <strong>This suggestion was closed on <?php echo $Suggestion->last_updated_datetime; ?> and rejected.</strong>
                </div>
            <?php } else if ($Suggestion->status == 'ACCEPTED') { ?>
                <div class="mb-4 border-l-2 border-green-500 bg-green-100 w-full lg:w-2/3 py-1 text-center mx-auto">
                    <strong>This suggestion was closed on <?php echo $Suggestion->last_updated_datetime; ?> and accepted.</strong>
                </div>
            <?php } else if ($Suggestion->status == 'IMPLEMENTED') { ?>
                <div class="mb-4 border-l-2 border-green-500 bg-green-100 w-full lg:w-2/3 py-1 text-center mx-auto">
                    <strong>This suggestion was closed on <?php echo $Suggestion->last_updated_datetime; ?> and has now been implemented.</strong>
                </div>
            <?php } else if ($Suggestion->status == 'SUBMITTED') { ?>
                <div class="mb-4 border-l-2 border-blue-500 bg-blue-100 w-full lg:w-2/3 py-1 text-center mx-auto">
                    <strong>This suggestion was submitted on <?php echo $Suggestion->datetime; ?> and is awaiting a response.</strong>
                </div>
            <?php } ?>

            <table class="border px-2 w-full lg:w-2/3 mx-auto mb-4">
                <tr>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2" colspan="2">Submitted By</th>
                </tr>
                <tr>
                    <td class="border border-neutral-300 py-1 px-2"><?php echo $Suggestion->name; ?></td>
                    <td class="border border-neutral-300 py-1 px-2"><?php echo $Suggestion->email; ?></td>
                </tr>
            </table>

            <table class="border px-2 w-full lg:w-2/3 mx-auto mb-4">
                <tr>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2" colspan="2">Suggestion</th>
                </tr>
                <tr>
                    <td class="border border-neutral-300 py-1 px-2">Title</td>
                    <td class="border border-neutral-300 py-1 px-2"><?php echo $Suggestion->title; ?></td>
                </tr>
                <tr>
                    <td class="border border-neutral-300 py-1 px-2">Message</td>
                    <td class="border border-neutral-300 py-1 px-2"><?php echo $Suggestion->message; ?></td>
                </tr>
            </table>

            <table class="border px-2 w-full lg:w-2/3 mx-auto mb-4">
                <tr>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2" colspan="2">Response</th>
                </tr>
                <tr>
                    <td class="border border-neutral-300 py-1 px-2">Status</td>
                    <td class="border border-neutral-300 py-1 px-2"><?php echo $Suggestion->status; ?></td>
                </tr>
                <tr>
                    <td class="border border-neutral-300 py-1 px-2">Message</td>
                    <td class="border border-neutral-300 py-1 px-2"><?php echo $Suggestion->status_reason; ?></td>
                </tr>
                <tr>
                    <td class="border border-neutral-300 py-1 px-2">Last Updated</td>
                    <td class="border border-neutral-300 py-1 px-2"><?php echo $Suggestion->last_updated_datetime; ?></td>
                </tr>
            </table>
        </main>
    </body>
</html>