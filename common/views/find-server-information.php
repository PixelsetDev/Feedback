<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require __DIR__ . '/../vendors.inc'; ?>

        <title>Feedback</title>
    </head>
    <body>
        <?php require __DIR__ . '/../navigation.inc'; ?>

        <header class="py-16">
            <h1 class="text-6xl w-full text-center font-bold">Find Server Information</h1>
        </header>

        <main class="pb-16 lg:px-32 md:px-20 sm:px-12 px-4 text-center">
            <h2 class="text-3xl font-bold">Saturn</h2>
            <ul class="list-disc ml-4">
                <li>Open the Admin Panel</li>
                <li>Scroll down to the "Your Server" section.</li>
            </ul>
            <p class="text-xs italics">If you can't access the Admin Panel, please follow the steps in the 'Other Software' section.</p>

            <h2 class="text-3xl font-bold mt-16">Other Software</h2>
            <ul class="list-disc ml-4">
                <li>Create a new PHP file called info.php on the server that hosts Saturn.</li>
                <li>Type the following into the file: &gt;?php echo phpinfo();</li>
                <li>Navigate to the file in your web browser and open it.</li>
                <li>The 'System' section contains information about your operating system.</li>
                <li>The PHP Version will be in large text at the top of the screen.</li>
            </ul>
        </main>
    </body>
</html>