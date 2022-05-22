<?php

use Boa\Database\SQL;

$SQL = new SQL();

if (isset($_POST['FeedbackMessage']) && isset($_POST['Product']) && isset($_POST['Name']) && isset($_POST['Email'])) {
    $Product = $SQL->Escape($_POST['Product']);
    $Name = $SQL->Escape($_POST['Name']);
    $Email = $SQL->Escape($_POST['Email']);
    $Message = $SQL->Escape($_POST['FeedbackMessage']);

    if ($SQL->Insert("feedback", "`id`, `product`, `datetime`, `name`, `email`, `message`", "NULL, '$Product', current_timestamp(), '$Name', '$Email', '$Message'")) {
        header('Location: ' . BASE_URI . '/software-feedback/?accepted=true');
    } else {

    }
} elseif (isset($_POST['SuggestionMessage']) && isset($_POST['Product']) && isset($_POST['Name']) && isset($_POST['Email'])) {
    header ('Location: '.BASE_URI.'/software-feedback/?accepted=true');
} elseif (isset($_POST['BugTitle']) && isset($_POST['Product']) && isset($_POST['Name']) && isset($_POST['Email'])) {
    header ('Location: '.BASE_URI.'/software-feedback/?accepted=true');
} else {
    header ('Location: '.BASE_URI.'/software-feedback/?accepted=false');
}
exit;