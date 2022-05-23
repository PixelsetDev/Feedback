<?php

use Boa\Database\SQL;

$SQL = new SQL();

if (isset($_POST['Product']) && $_POST['Product'] != NULL) {
    $Project = $SQL->Escape($_POST['Product']);
    if (isset($_POST['Name']) && $_POST['Name'] != NULL) {
        $Name = $SQL->Escape($_POST['Name']);
        if (isset($_POST['Email']) && $_POST['Email'] != NULL) {
            $Email = $SQL->Escape($_POST['Email']);
            if (isset($_POST['FeedbackMessage']) && $_POST['FeedbackMessage'] != NULL) {
                $Message = $SQL->Escape($_POST['FeedbackMessage']);

                if ($SQL->Insert("feedback", "`id`, `product`, `datetime`, `name`, `email`, `message`", "NULL, '$Project', current_timestamp(), '$Name', '$Email', '$Message'")) {
                    header('Location: ' . BASE_URI . '/software-feedback/?accepted=true');
                } else {
                    header('Location: ' . BASE_URI . '/software-feedback/?error=true&message=There was a problem connecting to the database.');
                }
            } elseif (isset($_POST['SuggestionMessage']) && $_POST['SuggestionMessage'] != NULL) {
                $Message = $SQL->Escape($_POST['SuggestionMessage']);

                if ($SQL->Insert("suggestions", "`id`, `product`, `datetime`, `name`, `email`, `message`", "NULL, '$Project', current_timestamp(), '$Name', '$Email', '$Message'")) {
                    header('Location: ' . BASE_URI . '/software-feedback/?accepted=true');
                } else {
                    header('Location: ' . BASE_URI . '/software-feedback/?error=true&message=There was a problem connecting to the database.');
                }
            } elseif (isset($_POST['BugTitle']) && $_POST['BugTitle'] != NULL) {
                $Type = $SQL->Escape($_POST['ReportType']);
                $Title = $SQL->Escape($_POST['BugTitle']);
                $Description = $SQL->Escape($_POST['BugDescription']);
                $Steps = $SQL->Escape($_POST['BugStepsToReproduce']);
                $ServerOS = $SQL->Escape($_POST['BugServerOS']);
                $ServerOSVersion = $SQL->Escape($_POST['BugServerOSVersion']);
                $PHPVersion = $SQL->Escape($_POST['BugPHPVersion']);
                $SoftwareVersion = $SQL->Escape($_POST['BugSoftwareVersion']);
                $Browser = $SQL->Escape($_POST['BugUserBrowser']);
                $BrowserVersion = $SQL->Escape($_POST['BugUserBrowserVersion']);

                if ($SQL->Insert("reports", "`id`, `project`, `datetime`, `name`, `email`, `type`, `status`, `priority`, `severity`, `title`, `description`, `steps`, `server_os`, `server_os_version`, `server_php_version`, `software_version`, `browser`, `browser_version`, `fixed_software_version`", "NULL, '$Project', current_timestamp(), '$Name', '$Email', '$Type', 'REPORTED', 0, 0, '$Title', '$Description', '$Steps', '$ServerOS', '$ServerOSVersion', '$PHPVersion', '$SoftwareVersion', '$Browser', '$BrowserVersion', NULL")) {
                    header('Location: ' . BASE_URI . '/software-feedback/?accepted=true');
                } else {
                    header('Location: ' . BASE_URI . '/software-feedback/?error=true&message=There was a problem connecting to the database.');
                }
            } else {
                header('Location: ' . BASE_URI . '/software-feedback/?error=true&message=The system could not determine which type of feedback you were submitting.');
            }
        } else {
            header('Location: ' . BASE_URI . '/software-feedback/?error=true&message=Email field was empty.');
        }
    } else {
        header('Location: ' . BASE_URI . '/software-feedback/?error=true&message=Name field was empty.');
    }
} else {
    header('Location: ' . BASE_URI . '/software-feedback/?error=true&message=No product was selected to send feedback for.');
}
exit;