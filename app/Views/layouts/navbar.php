<nav class="bg-sky-500 shadow sticky top-0 w-full p-0 z-50">
    <div class="flex justify-between items-center px-6 py-4">
        <a href="<?= base_url('home') ?>" class="flex items-center text-2xl font-semibold text-white">
            <i class="fa fa-book mr-3"></i> SalesRun
        </a>

        <div class="flex-1 flex justify-center">
            <ul class="flex space-x-8 text-lg">
                <li class="relative group">
                    <a href="<?= base_url('home') ?>" class=" <?= is_active('/home') ? 'text-blue-700 hover:text-blue-800' : 'text-white hover:text-orange-200 ' ?>">Home</a>
                </li>
                <li class="relative group">
                    <a href="<?= base_url('pipeline') ?>" class=" <?= is_active('pipeline') ? 'text-blue-700 hover:text-blue-800' : 'text-white hover:text-orange-200 ' ?>">Pipeline</a>
                    <div class="absolute right-0 hidden group-hover:block bg-white shadow-lg mt-2 p-2 w-48">
                        <a href="<?= base_url('pipeline') ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 whitespace-nowrap">Data Pipeline</a>
                        <a href="<?= base_url('pipeline/visit') ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 whitespace-nowrap">Visit Pipeline</a>
                        <a href="<?= base_url('pipeline/closing') ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 whitespace-nowrap">Closing Pipeline</a>
                    </div>
                </li>
                <li class="relative group">
                    <a href="<?= base_url('admin/master/product') ?>" class=" <?= is_active('/admin/master/product') ? 'text-blue-700 hover:text-blue-800' : 'text-white hover:text-orange-200 ' ?>">Master Data</a>
                </li>
            </ul>
        </div>

        <div class="ml-4">
            <a href="<?= base_url('') ?>" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>

<style>
    /* Menjaga dropdown tetap terbuka ketika berada di dalam menu Pipeline */
    .group:hover .group-hover\:block,
    .group-focus-within\:block {
        display: block !important;
    }
</style>