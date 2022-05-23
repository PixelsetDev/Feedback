<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require __DIR__ . '/../vendors.inc'; ?>

        <script>
            function ChangeType(type = 0) {
                if (document.getElementById("Type").value == 1 || type == 1) {
                    document.getElementById("Feedback").classList.remove("hidden");
                    document.getElementById("Feedback").classList.add("block");

                    document.getElementById("Suggestion").classList.remove("block");
                    document.getElementById("Suggestion").classList.add("hidden");
                    document.getElementById("Report").classList.remove("block");
                    document.getElementById("Report").classList.add("hidden");

                    console.log("Switched to Feedback");
                } else if (document.getElementById("Type").value == 2 || type == 2) {
                    document.getElementById("Suggestion").classList.remove("hidden");
                    document.getElementById("Suggestion").classList.add("block");

                    document.getElementById("Feedback").classList.remove("block");
                    document.getElementById("Feedback").classList.add("hidden");
                    document.getElementById("Report").classList.remove("block");
                    document.getElementById("Report").classList.add("hidden");

                    console.log("Switched to Suggestion");
                } else if (document.getElementById("Type").value == 3 || type == 3) {
                    document.getElementById("Report").classList.remove("hidden");
                    document.getElementById("Report").classList.add("block");

                    document.getElementById("Suggestion").classList.remove("block");
                    document.getElementById("Suggestion").classList.add("hidden");
                    document.getElementById("Feedback").classList.remove("block");
                    document.getElementById("Feedback").classList.add("hidden");

                    console.log("Switched to Bug Report");
                }
            }
        </script>
        <title>Websites Feedback</title>
    </head>
    <body>
        <?php require __DIR__ . '/../navigation.inc'; ?>

        <header class="py-16 w-full lg:w-2/3 mx-auto">
            <?php if (isset($_GET['accepted'])) { ?>
                <h1 class="text-6xl w-full text-center font-bold">We've got it!</h1>
                <p class="text-3xl w-full text-center">Thanks for your feedback.</p>
            <?php } else { ?>
                <h1 class="text-6xl w-full text-center font-bold">Websites Feedback</h1>
                <p class="text-3xl w-full text-center">Let us know how we're doing.</p>
            <?php } ?>
        </header>

        <?php if (isset($_GET['error'])) { ?>
            <div class="mb-8 border-l-2 border-red-500 bg-red-100 py-1 w-1/4 text-center mx-auto">
                <strong>Whoops, something went wrong.</strong><br><?php if (isset($_GET['message'])) { echo htmlspecialchars($_GET['message']); } ?>
            </div>
        <?php } ?>

        <?php if (!isset($_GET['accepted'])) { ?>
        <main class="pb-16 lg:px-32 md:px-20 sm:px-12 px-4 text-center">
            <label for="Type">Feedback Type</label><br>
            <select name="Type" id="Type" class="px-2 py-1 border border-neutral-500 rounded-md w-1/2 mb-8" onchange="ChangeType();" required>
                <option disabled selected>Please select one</option>
                <option value="1">Feedback</option>
                <option value="2">Suggestion</option>
                <option value="3">Bug or Error Report</option>
            </select>
            <form action="" method="POST" class="text-center">
                <label for="Product" class="<?php if (isset($_GET['product'])) { ?>hidden<?php } ?>">Product</label><br class="<?php if (isset($_GET['product'])) { ?>hidden<?php } ?>">
                <select name="Product" id="Product" class="px-2 py-1 border border-neutral-500 rounded-md w-1/2 mb-8<?php if (isset($_GET['product'])) { ?> hidden<?php } ?>" required>
                    <option disabled selected>Please select one</option>
                    <option value="GEOLHISTORY"<?php if (isset($_GET['product']) && $_GET['product'] == 'Boa') { echo 'selected'; } ?>>GeolHistory</option>
                    <option value="LEWMC"<?php if (isset($_GET['product']) && $_GET['product'] == 'Bonfire') { echo 'selected'; } ?>>LewMC</option>
                    <option value="LMWN"<?php if (isset($_GET['product']) && $_GET['product'] == 'Pixelset') { echo 'selected'; } ?>>LMWN Websites and Services</option>
                    <option value="WHATACCOMM"<?php if (isset($_GET['product']) && $_GET['product'] == 'Saturn') { echo 'selected'; } ?>>WhatAccomm</option>
                    <option value="PIXELSET-PHOTOGRAPHY"<?php if (isset($_GET['product']) && $_GET['product'] == 'Saturn') { echo 'selected'; } ?>>Pixelset Photography</option>
                </select>
                <div class="grid grid-cols-2 gap-x-8 w-1/2 mx-auto mb-8">
                    <label for="Name">Name</label>
                    <label for="Email">Email</label>
                    <input name="Name" id="Name" class="px-2 py-1 border border-neutral-500 rounded-md" placeholder="Name" type="text" maxlength="63" required>
                    <input name="Email" id="Email" class="px-2 py-1 border border-neutral-500 rounded-md" placeholder="Email" type="email" maxlength="63" required>
                </div>

                <div id="Feedback" class="hidden">
                    <label for="FeedbackMessage">Message</label><br>
                    <textarea name="FeedbackMessage" id="FeedbackMessage" class="px-2 py-1 border border-neutral-500 rounded-md w-1/2 mb-8" maxlength="511" placeholder="Please enter your feedback here."></textarea>
                    <input class="px-2 py-1 border border-neutral-500 shadow-lg rounded-md w-1/2 mb-8 hover:shadow-xl transition duration-200" value="Submit" type="submit">
                </div>

                <div id="Suggestion" class="hidden">
                    <div class="mb-8 border-l-2 border-blue-500 bg-blue-100 py-1 w-1/4 text-center mx-auto">
                        Please be aware that suggestions are public.
                    </div>
                    <label for="SuggestionTitle">Title</label><br>
                    <input name="SuggestionTitle" id="SuggestionTitle" type="text" class="px-2 py-1 border border-neutral-500 rounded-md w-1/2 mb-8" maxlength="63" placeholder="Please enter a brief title here."><br>
                    <label for="SuggestionMessage">Message</label><br>
                    <textarea name="SuggestionMessage" id="SuggestionMessage" class="px-2 py-1 border border-neutral-500 rounded-md w-1/2 mb-8" maxlength="511" placeholder="Please enter your suggestion here."></textarea>
                    <input class="px-2 py-1 border border-neutral-500 shadow-lg rounded-md w-1/2 mb-8 hover:shadow-xl transition duration-200" value="Submit" type="submit">
                </div>

                <div id="Report" class="hidden">
                    <div class="mb-8 border-l-2 border-blue-500 bg-blue-100 py-1 w-1/4 text-center mx-auto">
                        Please be aware that reports are public.
                    </div>

                    <br><label for="ReportType">Report Type</label><br>
                    <select name="ReportType" id="ReportType" class="px-2 py-1 border border-neutral-500 rounded-md w-1/2 mb-8">
                        <option disabled selected>Please select one</option>
                        <option value="BUG">Bug Report</option>
                        <option value="ERROR">Error Report</option>
                    </select>

                    <br><label for="BugTitle">Title</label><br>
                    <input name="BugTitle" id="BugTitle" class="px-2 py-1 border border-neutral-500 rounded-md w-1/2 mb-8" type="text" maxlength="63">

                    <br><label for="BugDescription">Description</label><br>
                    <textarea name="BugDescription" id="BugDescription" class="px-2 py-1 border border-neutral-500 rounded-md w-1/2 mb-8" maxlength="511" placeholder="Please enter a brief description here."></textarea>

                    <br><label for="BugStepsToReproduce">Steps to Reproduce</label><br>
                    <textarea name="BugStepsToReproduce" id="BugStepsToReproduce" class="px-2 py-1 border border-neutral-500 rounded-md w-1/2 mb-8" maxlength="511" placeholder="Please tell us how we can reproduce the issue on our end. What steps did you take to cause the issue?"></textarea>

                    <div class="grid grid-cols-2 gap-x-8 w-1/2 mx-auto mb-8 hidden">
                        <label for="BugServerOS">Server Operating System</label>
                        <label for="BugServerOSVersion">Server Operating System Version</label>
                        <select name="BugServerOS" id="BugServerOS" class="px-2 py-1 border border-neutral-500 rounded-md w-full" aria-hidden="true">
                            <option value="LINUX" selected>Linux</option>
                        </select>
                        <input name="BugServerOSVersion" id="BugServerOSVersion" value="<?php echo php_uname('v'); ?>" class="px-2 py-1 border border-neutral-500 rounded-md" type="text" aria-hidden="true">
                    </div>
                    <div class="grid grid-cols-2 gap-x-8 w-1/2 mx-auto mb-8 hidden">
                        <label for="BugPHPVersion">Server PHP Version</label>
                        <label for="BugSoftwareVersion"><?php if (isset($_GET['product']) && $_GET['product'] != null) { echo htmlspecialchars($_GET['product']); } else { ?>Software<?php } ?> Version</label>
                        <input name="BugPHPVersion" id="BugPHPVersion" class="px-2 py-1 border border-neutral-500 rounded-md" type="text">
                        <input name="BugSoftwareVersion" id="BugSoftwareVersion" class="px-2 py-1 border border-neutral-500 rounded-md" type="text">
                    </div>
    
                    <p class="text-xl font-bold">Device</p>
                    <p class="text-xs mb-2">This section is asking for information about the device that you're accessing the software on.</p>
    
                    <div class="grid grid-cols-2 gap-x-8 w-1/2 mx-auto mb-8">
                        <label for="BugUserBrowser">User Browser</label>
                        <label for="BugUserBrowserVersion">User Browser Version</label>
                        <select name="BugUserBrowser" id="BugUserBrowser" class="px-2 py-1 border border-neutral-500 rounded-md">
                            <option disabled selected>Please select one</option>
                            <option value="Google Chrome">Google Chrome</option>
                            <option value="Microsoft Edge">Microsoft Edge</option>
                            <option value="Safari">Safari</option>
                            <option value="Firefox">Firefox</option>
                            <option value="Internet Explorer">Internet Explorer</option>
                            <option value="Opera">Opera</option>
                            <option value="Brave">Brave</option>
                            <option value="Vivaldi">Vivaldi</option>
                            <option value="Samsung Internet">Samsung Internet</option>
                            <option value="Other">Other (Please specify in browser version text box)</option>
                        </select>
                        <input name="BugUserBrowserVersion" id="BugUserBrowserVersion" class="px-2 py-1 border border-neutral-500 rounded-md" type="text">
                    </div>
                    <input class="px-2 py-1 border border-neutral-500 shadow-lg rounded-md w-1/2 mb-8 hover:shadow-xl transition duration-200" value="Submit" type="submit">
                </div>
            </form>
        </main>
        <?php } ?>
    </body>
</html>