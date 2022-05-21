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
                    document.getElementById("BugReport").classList.remove("block");
                    document.getElementById("BugReport").classList.add("hidden");

                    console.log("Switched to Feedback");
                } else if (document.getElementById("Type").value == 2 || type == 2) {
                    document.getElementById("Suggestion").classList.remove("hidden");
                    document.getElementById("Suggestion").classList.add("block");

                    document.getElementById("Feedback").classList.remove("block");
                    document.getElementById("Feedback").classList.add("hidden");
                    document.getElementById("BugReport").classList.remove("block");
                    document.getElementById("BugReport").classList.add("hidden");

                    console.log("Switched to Suggestion");
                } else if (document.getElementById("Type").value == 3 || type == 3) {
                    document.getElementById("BugReport").classList.remove("hidden");
                    document.getElementById("BugReport").classList.add("block");

                    document.getElementById("Suggestion").classList.remove("block");
                    document.getElementById("Suggestion").classList.add("hidden");
                    document.getElementById("Feedback").classList.remove("block");
                    document.getElementById("Feedback").classList.add("hidden");

                    console.log("Switched to Bug Report");
                }
            }
        </script>
        <title>Software Feedback</title>
    </head>
    <body>
        <?php require __DIR__ . '/../navigation.inc'; ?>

        <header class="py-16">
            <?php if (isset($submitted) && $submitted) { ?>
            <h1 class="text-6xl w-full text-center font-bold">We've got it!</h1>
            <p class="text-3xl w-full text-center">Thanks for your feedback.</p>
            <?php } elseif (isset($submitted) && !$submitted) { ?>
            <h1 class="text-6xl w-full text-center font-bold">Whoops! Something went wrong...</h1>
                <p class="text-3xl w-full text-center">We haven't got your Feedback, sorry. If you require assistance please visit <a href="https://support.lmwn.co.uk/contact-us/" target="_blank" class="underline">our support website</a>, apologies for the inconvenience.</p>
            <?php } else { ?>
            <h1 class="text-6xl w-full text-center font-bold">Software Feedback</h1>
            <p class="text-3xl w-full text-center">Let us know how we're doing.</p>
            <?php } ?>
        </header>

        <?php if (!isset($submitted)) { ?>
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
                    <option value="BOA"<?php if (isset($_GET['product']) && $_GET['product'] == 'Boa') { echo 'selected'; } ?>>Boa</option>
                    <option value="BONFIRE"<?php if (isset($_GET['product']) && $_GET['product'] == 'Bonfire') { echo 'selected'; } ?> onclick="">Bonfire</option>
                    <option value="PIXELSET"<?php if (isset($_GET['product']) && $_GET['product'] == 'Pixelset') { echo 'selected'; } ?> onclick="">Pixelset</option>
                    <option value="SATURN"<?php if (isset($_GET['product']) && $_GET['product'] == 'Saturn') { echo 'selected'; } ?>>Saturn</option>
                </select>
                <div class="grid grid-cols-2 gap-x-8 w-1/2 mx-auto mb-8">
                    <label for="Name">Name</label>
                    <label for="Email">Email</label>
                    <input name="Name" id="Name" class="px-2 py-1 border border-neutral-500 rounded-md" placeholder="Name" type="text" required>
                    <input name="Email" id="Email" class="px-2 py-1 border border-neutral-500 rounded-md" placeholder="Email" type="email" required>
                </div>
                <div id="Feedback" class="hidden">
                    <label for="FeedbackMessage">Message</label><br>
                    <textarea name="FeedbackMessage" id="FeedbackMessage" class="px-2 py-1 border border-neutral-500 rounded-md w-1/2 mb-8" placeholder="Please enter your feedback here."></textarea>
                </div>
                <div id="Suggestion" class="hidden">
                    <label for="SuggestionMessage">Message</label><br>
                    <textarea name="SuggestionMessage" id="SuggestionMessage" class="px-2 py-1 border border-neutral-500 rounded-md w-1/2 mb-8" placeholder="Please enter your suggestion here."></textarea>
                </div>
                <div id="BugReport" class="hidden">
                    <label for="BugTitle">Title</label><br>
                    <input name="BugTitle" id="BugTitle" class="px-2 py-1 border border-neutral-500 rounded-md w-1/2 mb-8" type="text">

                    <br><label for="BugDescription">Description</label><br>
                    <textarea name="BugDescription" id="BugDescription" class="px-2 py-1 border border-neutral-500 rounded-md w-1/2 mb-8" placeholder="Please enter a brief description here."></textarea>

                    <br><label for="BugStepsToReproduce">Steps to Reproduce</label><br>
                    <textarea name="BugStepsToReproduce" id="BugStepsToReproduce" class="px-2 py-1 border border-neutral-500 rounded-md w-1/2 mb-8" placeholder="Please tell us how we can reproduce the issue on our end. What steps did you take to cause the issue?"></textarea>

                    <p class="text-xl font-bold">Server Information</p>
                    <p class="text-xs mb-2">This section is asking for information about the server that the software runs on. <a href="../find-server-information" target="_blank" class="underline">Need Help? Click here.</a> (opens in new tab).</p>

                    <div class="grid grid-cols-2 gap-x-8 w-1/2 mx-auto mb-8">
                        <label for="BugServerOS">Server Operating System</label>
                        <label for="BugServerOSVersion">Server Operating System Version</label>
                        <input name="BugServerOS" id="BugServerOS" class="px-2 py-1 border border-neutral-500 rounded-md" type="text">
                        <input name="BugServerOSVersion" id="BugServerOSVersion" class="px-2 py-1 border border-neutral-500 rounded-md" type="text">
                    </div>
                    <div class="grid grid-cols-2 gap-x-8 w-1/2 mx-auto mb-8">
                        <label for="BugPHPVersion">Server PHP Version</label>
                        <label for="BugSoftwareVersion">Software Version</label>
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
                            <option value="Other">Other</option>
                        </select>
                        <input name="BugUserBrowserVersion" id="BugUserBrowserVersion" class="px-2 py-1 border border-neutral-500 rounded-md" type="text">
                    </div>
                </div>
                <input class="px-2 py-1 border border-neutral-500 shadow-lg rounded-md w-1/2 mb-8 hover:shadow-xl transition duration-200" value="Submit" type="submit">
            </form>
        </main>
        <?php } ?>
    </body>
</html>