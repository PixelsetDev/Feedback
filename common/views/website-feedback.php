<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require __DIR__ . '/../vendors.inc'; ?>

        <script>
            function ChangeType() {
                if (document.getElementById("type").value == 1) {
                    document.getElementById("Feedback").classList.remove("hidden");
                    document.getElementById("Feedback").classList.add("block");

                    document.getElementById("Suggestion").classList.remove("block");
                    document.getElementById("Suggestion").classList.add("hidden");
                    document.getElementById("BugReport").classList.remove("block");
                    document.getElementById("BugReport").classList.add("hidden");

                    console.log("Switched to Feedback");
                } else if (document.getElementById("type").value == 2) {
                    document.getElementById("Suggestion").classList.remove("hidden");
                    document.getElementById("Suggestion").classList.add("block");

                    document.getElementById("Feedback").classList.remove("block");
                    document.getElementById("Feedback").classList.add("hidden");
                    document.getElementById("BugReport").classList.remove("block");
                    document.getElementById("BugReport").classList.add("hidden");

                    console.log("Switched to Suggestion");
                } else if (document.getElementById("type").value == 3) {
                    document.getElementById("BugReport").classList.remove("hidden");
                    document.getElementById("BugReport").classList.add("block");

                    document.getElementById("Suggestion").classList.remove("block");
                    document.getElementById("Suggestion").classList.add("hidden");
                    document.getElementById("Feedback").classList.remove("block");
                    document.getElementById("Feedback").classList.add("hidden");

                    console.log("Switched to Bug Report");
                } else {
                    console.log("Error: Unable to determine type (returned "+document.getElementById("type").value+").");
                }
            }
        </script>
        <title>Website Feedback</title>
    </head>
    <body>
        <?php require __DIR__ . '/../navigation.inc'; ?>

        <header class="py-16">
            <h1 class="text-6xl w-full text-center font-bold">Website Feedback</h1>
            <p class="text-3xl w-full text-center">Let us know how we're doing.</p>
        </header>

        <main class="pb-16 lg:px-32 md:px-20 sm:px-12 px-4 text-center">
            <label for="type">Feedback Type</label><br>
            <select name="type" id="type" class="px-2 py-1 border border-neutral-500 rounded-md w-1/2 mb-8" onchange="ChangeType();" required>
                <option disabled selected>Please select one</option>
                <option value="1">Feedback</option>
                <option value="2">Suggestion</option>
                <option value="3">Bug or Error Report</option>
            </select>
            <form action="" method="POST" class="text-center">
                <label for="product" class="<?php if (isset($_GET['product'])) { ?>hidden<?php } ?>">Product</label><br class="<?php if (isset($_GET['product'])) { ?>hidden<?php } ?>">
                <select name="product" id="product" class="px-2 py-1 border border-neutral-500 rounded-md w-1/2 mb-8<?php if (isset($_GET['product'])) { ?> hidden<?php } ?>" required>
                    <option disabled selected>Please select one</option>
                </select>
                <div class="grid grid-cols-2 gap-x-8 w-1/2 mx-auto mb-8">
                    <label for="name">Name</label>
                    <label for="email">Email</label>
                    <input name="name" id="name" class="px-2 py-1 border border-neutral-500 rounded-md" placeholder="Name" type="text" required>
                    <input name="email" id="email" class="px-2 py-1 border border-neutral-500 rounded-md" placeholder="Email" type="email" required>
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
                    <label for="BugDescription">Description</label><br>
                    <textarea name="BugDescription" id="BugDescription" class="px-2 py-1 border border-neutral-500 rounded-md w-1/2 mb-8" placeholder="Please enter a brief description here."></textarea>

                    <p class="text-xl font-bold">Server Information</p>
                    <p class="text-xs mb-2">This section is asking for information about the server that the software runs on. <a href="/find-server-information" target="_blank" class="underline">Need Help? Click here.</a> (opens in new tab).</p>

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
    </body>
</html>