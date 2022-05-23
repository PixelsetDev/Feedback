<?php
global $SQL;
global $Projects;

$project = null;

foreach($Projects as $Project) {
    if (str_contains($_SERVER['REQUEST_URI'], $Project[0])) {
        $project = $Project[0];
    }
}

$Reports = $SQL->Select('*', 'reports', '`project` = \''.strtoupper($project).'\' AND `status` <> \'RESOLVED\'', 'ALL:ASSOC');
$NumReports = $SQL->Select('*', 'reports', '`project` = \''.strtoupper($project).'\' AND `status` <> \'RESOLVED\'', 'NUM_ROWS');

$ClosedReports = $SQL->Select('*', 'reports', '`project` = \''.strtoupper($project).'\' AND `status` = \'RESOLVED\'', 'ALL:ASSOC');
$NumClosedReports = $SQL->Select('*', 'reports', '`project` = \''.strtoupper($project).'\' AND `status` = \'RESOLVED\'', 'NUM_ROWS');

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

        <title><?php echo ucfirst($project); ?> Reports - Feedback</title>
    </head>
    <body>
        <?php require __DIR__ . '/../navigation.inc'; ?>

        <header class="py-16">
            <h1 class="text-6xl w-full text-center font-bold"><?php echo ucfirst($project); ?> Reports</h1>
            <p class="text-3xl w-full text-center">The <?php echo ucfirst($project); ?> issue tracker.</p>
        </header>

        <main class="pb-16 lg:px-32 md:px-20 sm:px-12 px-4 text-center">
            <p class="border border-neutral-300 bg-neutral-200 py-1 px-2 px-2 w-full lg:w-2/3 mx-auto font-bold">
                Open Reports
            </p>
            <table class="border px-2 w-full lg:w-2/3 mx-auto">
                <tr>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Type</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Title</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Status</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Priority</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Severity</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Affected Version</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Last Updated</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2"></th>
                </tr>
                <?php if ($NumReports > 0) { $i=1; foreach ($Reports as $Report) { if ($i % 2 == 0) { ?>
                    <tr>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo Icon_Type($Report['type']); ?></td>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo $Report['title']; ?></td>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo $Report['status']; ?></td>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo Icon_Priority_Severity($Report['priority']); ?></td>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo Icon_Priority_Severity($Report['severity']); ?></td>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo $Report['software_version']; ?></td>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo $Report['last_updated_datetime']; ?></td>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><a href="reports/<?php echo $Report['id']; ?>"><i class="fa-solid fa-magnifying-glass-plus"></i></a></td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td class="border border-neutral-300 py-1 px-2"><?php echo Icon_Type($Report['type']); ?></td>
                        <td class="border border-neutral-300 py-1 px-2"><?php echo $Report['title']; ?></td>
                        <td class="border border-neutral-300 py-1 px-2"><?php echo $Report['status']; ?></td>
                        <td class="border border-neutral-300 py-1 px-2"><?php echo Icon_Priority_Severity($Report['priority']); ?></td>
                        <td class="border border-neutral-300 py-1 px-2"><?php echo Icon_Priority_Severity($Report['severity']); ?></td>
                        <td class="border border-neutral-300 py-1 px-2"><?php echo $Report['software_version']; ?></td>
                        <td class="border border-neutral-300 py-1 px-2 invisible lg:contents"><?php echo $Report['last_updated_datetime']; ?></td>
                        <td class="border border-neutral-300 py-1 px-2"><a href="reports/<?php echo $Report['id']; ?>"><i class="fa-solid fa-magnifying-glass-plus"></i></a></td>
                    </tr>
                <?php } $i++; } } else { ?>
                    <tr>
                        <td colspan="7" class="border py-1 px-2">No open reports.</td>
                    </tr>
                <?php } ?>
            </table>

            <br><br>

            <p class="border border-neutral-300 bg-neutral-200 py-1 px-2 px-2 w-full lg:w-2/3 mx-auto font-bold">
                Resolved / Closed Reports
            </p>
            <table class="border px-2 w-full lg:w-2/3 mx-auto">
                <tr>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Type</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Title</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Status</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Priority</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Severity</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Affected Version</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Resolved in Version</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Last Updated</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2"></th>
                </tr>
                <?php if ($NumClosedReports > 0) { $i=1; foreach ($ClosedReports as $Report) { if ($i % 2 == 0) { ?>
                <tr>
                    <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo Icon_Type($Report['type']); ?></td>
                    <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo $Report['title']; ?></td>
                    <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo $Report['status']; ?></td>
                    <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo Icon_Priority_Severity($Report['priority']); ?></td>
                    <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo Icon_Priority_Severity($Report['severity']); ?></td>
                    <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo $Report['software_version']; ?></td>
                    <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo $Report['fixed_software_version']; ?></td>
                    <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo $Report['last_updated_datetime']; ?></td>
                    <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><a href="reports/<?php echo $Report['id']; ?>"><i class="fa-solid fa-magnifying-glass-plus"></i></a></td>
                </tr>
                <?php } else { ?>
                <tr>
                    <td class="border border-neutral-300 py-1 px-2"><?php echo Icon_Type($Report['type']); ?></td>
                    <td class="border border-neutral-300 py-1 px-2"><?php echo $Report['title']; ?></td>
                    <td class="border border-neutral-300 py-1 px-2"><?php echo $Report['status']; ?></td>
                    <td class="border border-neutral-300 py-1 px-2"><?php echo Icon_Priority_Severity($Report['priority']); ?></td>
                    <td class="border border-neutral-300 py-1 px-2"><?php echo Icon_Priority_Severity($Report['severity']); ?></td>
                    <td class="border border-neutral-300 py-1 px-2"><?php echo $Report['software_version']; ?></td>
                    <td class="border border-neutral-300 py-1 px-2"><?php echo $Report['fixed_software_version']; ?></td>
                    <td class="border border-neutral-300 py-1 px-2"><?php echo $Report['last_updated_datetime']; ?></td>
                    <td class="border border-neutral-300 py-1 px-2"><a href="reports/<?php echo $Report['id']; ?>"><i class="fa-solid fa-magnifying-glass-plus"></i></a></td>
                </tr>
                <?php } $i++; } } else { ?>
                    <tr>
                        <td colspan="8" class="border py-1 px-2">No closed reports.</td>
                    </tr>
                <?php } ?>
            </table>
        </main>
    </body>
</html>