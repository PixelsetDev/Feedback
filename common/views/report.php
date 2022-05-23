<?php
global $SQL;
global $Projects;

$id = $SQL->Escape(basename($_SERVER['REQUEST_URI']));

foreach($Projects as $Project) {
    if (str_contains($_SERVER['REQUEST_URI'], $Project[0])) {
        $project = $Project[0];
    }
}

$Report = $SQL->Select('*', 'reports', '`id` = \''.$id.'\'', 'OBJECT');

function Icon_Priority_Severity($value): string
{
    return match ($value) {
        '0' => '<i class="fa-solid fa-circle-question" aria-label="Unknown"></i>',
        '1' => '<i class="fa-solid fa-angles-down" aria-label="Very low"></i>',
        '2' => '<i class="fa-solid fa-angle-down" aria-label="Low"></i>',
        '3' => '<i class="fa-solid fa-grip-lines" aria-label="Normal"></i>',
        '4' => '<i class="fa-solid fa-angle-up" aria-label="High"></i>',
        '5' => '<i class="fa-solid fa-angles-up" aria-label="Very high"></i>',
        '6' => '<i class="fa-solid fa-triangle-exclamation" aria-label="Immediate / Severe"></i>'
    };
}
function Icon_Type($value): string
{
    return match ($value) {
        'ERROR' => '<i class="fa-solid fa-burst" aria-label="Error"></i>',
        default => '<i class="fa-solid fa-bug" aria-label="Bug"></i>'
    };
}
?><!DOCTYPE html>
<html lang="en">
    <head>
        <?php require __DIR__ . '/../vendors.inc'; ?>

        <title>Report #<?php echo $id; ?> - <?php echo ucfirst($project); ?> Reports - Feedback</title>
    </head>
    <body>
        <?php require __DIR__ . '/../navigation.inc'; ?>

        <header class="py-16">
            <h1 class="text-6xl w-full text-center font-bold"><?php echo ucfirst($project); ?> Reports</h1>
            <p class="text-3xl w-full text-center">Report #<?php echo $id; ?></p>
        </header>

        <main class="pb-16 lg:px-32 md:px-20 sm:px-12 px-4 text-center">

            <?php if ($Report->status == 'CLOSED') { ?>
                <div class="mb-4 border-l-2 border-red-500 bg-red-100 w-full lg:w-2/3 py-1 text-center mx-auto">
                    <strong>This report was closed on <?php echo $Report->last_updated_datetime; ?> and marked as not resolved.</strong>
                </div>
            <?php } else if ($Report->status == 'RESOLVED') { ?>
                <div class="mb-4 border-l-2 border-green-500 bg-green-100 w-full lg:w-2/3 py-1 text-center mx-auto">
                    <strong>This report was closed on <?php echo $Report->last_updated_datetime; ?> and marked as resolved.</strong><br>
                    This report is fixed in version <?php echo $Report->fixed_software_version; ?>.
                </div>
            <?php } ?>

            <table class="border px-2 w-full lg:w-2/3 mx-auto mb-4">
                <tr>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2" colspan="2">Reported By</th>
                </tr>
                <tr>
                    <td class="border border-neutral-300 py-1 px-2"><?php echo $Report->name; ?></td>
                    <td class="border border-neutral-300 py-1 px-2"><?php echo $Report->email; ?></td>
                </tr>
            </table>

            <table class="border px-2 w-full lg:w-2/3 mx-auto mb-4">
                <tr>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2" colspan="2">Report Information</th>
                </tr>
                <tr>
                    <td class="border border-neutral-300 py-1 px-2">Title</td>
                    <td class="border border-neutral-300 py-1 px-2 flex-grow"><?php echo $Report->title; ?></td>
                </tr>
                <tr>
                    <td class="border border-neutral-300 bg-neutral-100 py-1 px-2">Description</td>
                    <td class="border border-neutral-300 bg-neutral-100 py-1 px-2 flex-grow"><?php echo $Report->description; ?></td>
                </tr>
                <tr>
                    <td class="border border-neutral-300 py-1 px-2">Steps to Reproduce</td>
                    <td class="border border-neutral-300 py-1 px-2 flex-grow"><?php echo $Report->steps; ?></td>
                </tr>
                <tr>
                    <td class="border border-neutral-300 py-1 px-2">Type</td>
                    <td class="border border-neutral-300 py-1 px-2 flex-grow"><?php echo $Report->type; ?></td>
                </tr>
                <tr>
                    <td class="border border-neutral-300 bg-neutral-100 py-1 px-2">Priority</td>
                    <td class="border border-neutral-300 bg-neutral-100 py-1 px-2 flex-grow"><?php echo Icon_Priority_Severity($Report->priority); ?> (<?php echo $Report->priority; ?>)</td>
                </tr>
                <tr>
                    <td class="border border-neutral-300 py-1 px-2">Severity</td>
                    <td class="border border-neutral-300 py-1 px-2 flex-grow"><?php echo Icon_Priority_Severity($Report->severity); ?> (<?php echo $Report->severity; ?>)</td>
                </tr>
                <tr>
                    <td class="border border-neutral-300 bg-neutral-100 py-1 px-2">Status</td>
                    <td class="border border-neutral-300 bg-neutral-100 py-1 px-2 flex-grow"><?php echo $Report->status; ?></td>
                </tr>
                <tr>
                    <td class="border border-neutral-300 py-1 px-2">Affected Version</td>
                    <td class="border border-neutral-300 py-1 px-2 flex-grow"><?php echo $Report->software_version; ?></td>
                </tr>
                <tr>
                    <td class="border border-neutral-300 bg-neutral-100 py-1 px-2">Last Updated</td>
                    <td class="border border-neutral-300 bg-neutral-100 py-1 px-2 flex-grow"><?php echo $Report->last_updated_datetime; ?></td>
                </tr>
                <?php if ($Report->status == 'RESOLVED') { ?>
                    <tr>
                        <td class="border border-neutral-300 py-1 px-2">Fixed Version</td>
                        <td class="border border-neutral-300 py-1 px-2 flex-grow"><?php echo $Report->fixed_software_version; ?></td>
                    </tr>
                <?php } ?>
            </table>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full lg:w-2/3 mx-auto">
                <table class="border px-2 w-full">
                    <tr>
                        <th class="border border-neutral-300 bg-neutral-200 py-1 px-2" colspan="2">Server Information</th>
                    </tr>
                    <tr>
                        <td class="border border-neutral-300 py-1 px-2">Operating System</td>
                        <td class="border border-neutral-300 py-1 px-2 flex-grow"><?php echo $Report->server_os; ?></td>
                    </tr>
                    <tr>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2">OS Version</td>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2 flex-grow"><?php echo $Report->server_os_version; ?></td>
                    </tr>
                    <tr>
                        <td class="border border-neutral-300 py-1 px-2">PHP Version</td>
                        <td class="border border-neutral-300 py-1 px-2 flex-grow<?php if ($Report->server_php_version < '7.4') { echo ' text-red-500'; } ?>"><?php echo $Report->server_php_version; ?></td>
                    </tr>
                </table>

                <table class="border px-2 w-full">
                    <tr>
                        <th class="border border-neutral-300 bg-neutral-200 py-1 px-2" colspan="2">Device Information</th>
                    </tr>
                    <tr>
                        <td class="border border-neutral-300 py-1 px-2">Browser</td>
                        <td class="border border-neutral-300 py-1 px-2 flex-grow"><?php echo $Report->browser; ?></td>
                    </tr>
                    <tr>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2">Browser Version</td>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2 flex-grow"><?php echo $Report->browser_version; ?></td>
                    </tr>
                </table>
            </div>
        </main>
    </body>
</html>