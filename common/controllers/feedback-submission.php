<?php

if (isset($_POST['FeedbackMessage']) && isset($_POST['Product']) && isset($_POST['Name']) && isset($_POST['Email'])) {
    $submitted = true;
} elseif (isset($_POST['SuggestionMessage']) && isset($_POST['Product']) && isset($_POST['Name']) && isset($_POST['Email'])) {
    $submitted = true;
} elseif (isset($_POST['BugTitle']) && isset($_POST['Product']) && isset($_POST['Name']) && isset($_POST['Email'])) {
    $submitted = true;
} else {
    $submitted = false;
}