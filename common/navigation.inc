<nav class="bg-neutral-900 z-40 w-full">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between py-2">
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" ><img src="https://brand.lmwn.co.uk/logo.png" class="h-6 w-auto" alt="LMWN Logo"></a>
                </div>
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-4">
                        <a href="/" class="text-neutral-300 hover:bg-neutral-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
                        <div @click="open = true" x-data="{ open: false }" class="cursor-pointer text-neutral-300 hover:bg-neutral-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            <span class="">Send Feedback</span>
                            <div x-show="open" @click.away="open = false" class="overflow-hidden origin-top-left absolute left-1/6 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5" style="display: none;">
                                <div role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                    <?php
                                    global $SQL;
                                    $NavCategories = $SQL->Select('`id`, `name`, `slug`', 'categories', '1', 'ALL:ASSOC');
                                    foreach ($NavCategories as $NavCategory) {
                                    ?>
                                    <a href="/<?php echo $NavCategory['slug']; ?>-feedback" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem"><?php echo $NavCategory['name']; ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div @click="open = true" x-data="{ open: false }" class="cursor-pointer text-neutral-300 hover:bg-neutral-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            <span class="">View Feedback</span>
                            <div x-show="open" @click.away="open = false" class="origin-top-left absolute left-1/6 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5" style="display: none;">
                                <div role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                    <?php
                                    global $SQL;
                                    foreach ($NavCategories as $NavCategory) { ?>
                                        <div @click="open = true" x-data="{ open: false }" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                            <span class=""><?php echo $NavCategory['name']; ?></span>
                                            <div x-show="open" @click.away="open = false" class="origin-top-left absolute left-1/6 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5" style="display: none;">
                                                <div role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                                    <?php
                                                    global $SQL;
                                                    $NavProjects = $SQL->Select('`name`, `slug`', 'projects', '`visible` = 1 AND `category` = '.$NavCategory['id'], 'ALL:ASSOC');
                                                    foreach ($NavProjects as $NavProject) {
                                                    ?>
                                                    <a href="/<?php echo $NavProject['slug']; ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem"><?php echo $NavProject['name']; ?></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } unset($NavCategories, $NavProjects) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>