<?php
global $SQL;
global $Projects;

$project = null;

foreach($Projects as $Project) {
    if (str_contains($_SERVER['REQUEST_URI'], $Project[0])) {
        $project = $Project[0];
    }
}

$Suggestions = $SQL->Select('*', 'suggestions', '`product` = \''.strtoupper($project).'\' AND `status` <> \'REJECTED\' AND `status` <> \'ACCEPTED\'', 'ALL:ASSOC');
$NumSuggestions = $SQL->Select('*', 'suggestions', '`product` = \''.strtoupper($project).'\' AND `status` <> \'REJECTED\' AND `status` <> \'ACCEPTED\'', 'NUM_ROWS');

$RejectedSuggestions = $SQL->Select('*', 'suggestions', '`product` = \''.strtoupper($project).'\' AND `status` = \'REJECTED\'', 'ALL:ASSOC');
$NumRejectedSuggestions = $SQL->Select('*', 'suggestions', '`product` = \''.strtoupper($project).'\' AND `status` = \'REJECTED\'', 'NUM_ROWS');

$AcceptedSuggestions = $SQL->Select('*', 'suggestions', '`product` = \''.strtoupper($project).'\' AND `status` = \'ACCEPTED\'', 'ALL:ASSOC');
$NumAcceptedSuggestions = $SQL->Select('*', 'suggestions', '`product` = \''.strtoupper($project).'\' AND `status` = \'ACCEPTED\'', 'NUM_ROWS');

$ImplementedSuggestions = $SQL->Select('*', 'suggestions', '`product` = \''.strtoupper($project).'\' AND `status` = \'IMPLEMENTED\'', 'ALL:ASSOC');
$NumImplementedSuggestions = $SQL->Select('*', 'suggestions', '`product` = \''.strtoupper($project).'\' AND `status` = \'IMPLEMENTED\'', 'NUM_ROWS');

?><!DOCTYPE html>
<html lang="en">
    <head>
        <?php require __DIR__ . '/../vendors.inc'; ?>

        <title><?php echo ucfirst($project); ?> Suggestions - Feedback</title>
    </head>
    <body>
        <?php require __DIR__ . '/../navigation.inc'; ?>

        <header class="py-16">
            <h1 class="text-6xl w-full text-center font-bold"><?php echo ucfirst($project); ?> Suggestions</h1>
            <p class="text-3xl w-full text-center">The <?php echo ucfirst($project); ?> ideas pool.</p>
        </header>

        <main class="pb-16 lg:px-32 md:px-20 sm:px-12 px-4 text-center">
            <p class="border border-neutral-300 bg-neutral-200 py-1 px-2 px-2 w-full lg:w-2/3 mx-auto font-bold">
                Suggestions awaiting a response
            </p>
            <table class="border px-2 w-full lg:w-2/3 mx-auto">
                <tr>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Name</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Suggestion</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2"></th>
                </tr>
                <?php if ($NumSuggestions > 0) { $i=1; foreach ($Suggestions as $Suggestion) { if ($i % 2 == 0) { ?>
                    <tr>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo $Suggestion['name']; ?></td>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo $Suggestion['message']; ?></td>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><a href="suggestions/<?php echo $Suggestion['id']; ?>"><i class="fa-solid fa-magnifying-glass-plus"></i></a></td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td class="border border-neutral-300 py-1 px-2"><?php echo $Suggestion['name']; ?></td>
                        <td class="border border-neutral-300 py-1 px-2"><?php echo $Suggestion['message']; ?></td>
                        <td class="border border-neutral-300 py-1 px-2"><a href="suggestions/<?php echo $Suggestion['id']; ?>"><i class="fa-solid fa-magnifying-glass-plus"></i></a></td>
                    </tr>
                <?php } $i++; } } else { ?>
                    <tr>
                        <td colspan="4" class="border py-1 px-2">No suggestions are awaiting a response.</td>
                    </tr>
                <?php } ?>
            </table>

            <br><br>

            <p class="border border-neutral-300 bg-neutral-200 py-1 px-2 px-2 w-full lg:w-2/3 mx-auto font-bold">
                Accepted Suggestions
            </p>
            <table class="border px-2 w-full lg:w-2/3 mx-auto">
                <tr>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Name</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Suggestion</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Response</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2"></th>
                </tr>
                <?php if ($NumAcceptedSuggestions > 0) { $i=1; foreach ($AcceptedSuggestions as $Suggestion) { if ($i % 2 == 0) { ?>
                    <tr>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo $Suggestion['name']; ?></td>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo $Suggestion['message']; ?></td>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo $Suggestion['status_reason']; ?></td>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><a href="suggestions/<?php echo $Suggestion['id']; ?>"><i class="fa-solid fa-magnifying-glass-plus"></i></a></td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td class="border border-neutral-300 py-1 px-2"><?php echo $Suggestion['name']; ?></td>
                        <td class="border border-neutral-300 py-1 px-2"><?php echo $Suggestion['message']; ?></td>
                        <td class="border border-neutral-300 py-1 px-2"><?php echo $Suggestion['status_reason']; ?></td>
                        <td class="border border-neutral-300 py-1 px-2"><a href="suggestions/<?php echo $Suggestion['id']; ?>"><i class="fa-solid fa-magnifying-glass-plus"></i></a></td>
                    </tr>
                <?php } $i++; } } else { ?>
                    <tr>
                        <td colspan="4" class="border py-1 px-2">No suggestions have been accepted yet.</td>
                    </tr>
                <?php } ?>
            </table>

            <br><br>

            <p class="border border-neutral-300 bg-neutral-200 py-1 px-2 px-2 w-full lg:w-2/3 mx-auto font-bold">
                Implemented Suggestions
            </p>
            <table class="border px-2 w-full lg:w-2/3 mx-auto">
                <tr>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Name</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Suggestion</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Response</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2"></th>
                </tr>
                <?php if ($NumImplementedSuggestions > 0) { $i=1; foreach ($ImplementedSuggestions as $Suggestion) { if ($i % 2 == 0) { ?>
                    <tr>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo $Suggestion['name']; ?></td>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo $Suggestion['message']; ?></td>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo $Suggestion['status_reason']; ?></td>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><a href="suggestions/<?php echo $Suggestion['id']; ?>"><i class="fa-solid fa-magnifying-glass-plus"></i></a></td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td class="border border-neutral-300 py-1 px-2"><?php echo $Suggestion['name']; ?></td>
                        <td class="border border-neutral-300 py-1 px-2"><?php echo $Suggestion['message']; ?></td>
                        <td class="border border-neutral-300 py-1 px-2"><?php echo $Suggestion['status_reason']; ?></td>
                        <td class="border border-neutral-300 py-1 px-2"><a href="suggestions/<?php echo $Suggestion['id']; ?>"><i class="fa-solid fa-magnifying-glass-plus"></i></a></td>
                    </tr>
                <?php } $i++; } } else { ?>
                    <tr>
                        <td colspan="4" class="border py-1 px-2">No suggestions have been implemented yet.</td>
                    </tr>
                <?php } ?>
            </table>

            <br><br>

            <p class="border border-neutral-300 bg-neutral-200 py-1 px-2 px-2 w-full lg:w-2/3 mx-auto font-bold">
                Rejected Suggestions
            </p>
            <table class="border px-2 w-full lg:w-2/3 mx-auto">
                <tr>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Name</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Suggestion</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2">Response</th>
                    <th class="border border-neutral-300 bg-neutral-200 py-1 px-2"></th>
                </tr>
                <?php if ($NumRejectedSuggestions > 0) { $i=1; foreach ($RejectedSuggestions as $Suggestion) { if ($i % 2 == 0) { ?>
                    <tr>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo $Suggestion['name']; ?></td>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo $Suggestion['message']; ?></td>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><?php echo $Suggestion['status_reason']; ?></td>
                        <td class="border border-neutral-300 bg-neutral-100 py-1 px-2"><a href="suggestions/<?php echo $Suggestion['id']; ?>"><i class="fa-solid fa-magnifying-glass-plus"></i></a></td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td class="border border-neutral-300 py-1 px-2"><?php echo $Suggestion['name']; ?></td>
                        <td class="border border-neutral-300 py-1 px-2"><?php echo $Suggestion['message']; ?></td>
                        <td class="border border-neutral-300 py-1 px-2"><?php echo $Suggestion['status_reason']; ?></td>
                        <td class="border border-neutral-300 py-1 px-2"><a href="suggestions/<?php echo $Suggestion['id']; ?>"><i class="fa-solid fa-magnifying-glass-plus"></i></a></td>
                    </tr>
                <?php } $i++; } } else { ?>
                    <tr>
                        <td colspan="4" class="border py-1 px-2">No suggestions have been rejected yet.</td>
                    </tr>
                <?php } ?>
            </table>
        </main>
    </body>
</html>