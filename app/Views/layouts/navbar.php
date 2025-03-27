<!-- Navbar -->
<nav class="bg-white shadow-md sticky top-0 w-full z-50">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">

        <!-- Logo -->
        <a href="<?= base_url('home') ?>" class="flex items-center text-2xl font-semibold text-sky-600">
            <i class="fa fa-book mr-2"></i> SalesRun
        </a>

        <!-- Menu -->
        <div class="hidden md:flex space-x-6">
            <?= NavLink('home', 'Home') ?>
            <?= NavLinkDropdown('Pipeline', [
                ['url' => 'pipeline', 'label' => 'Data Pipeline'],
                ['url' => 'pipeline/visit', 'label' => 'Visit Pipeline'],
                ['url' => 'pipeline/closing', 'label' => 'Closing Pipeline']
            ]) ?>
            <?= NavLinkDropdown('Performance', [
                ['url' => 'performance/target', 'label' => 'Target'],
                ['url' => 'performance/actual', 'label' => 'Actual'],
                ['url' => 'performance/scorecard', 'label' => 'Scorecard']
            ]) ?>
            <?= NavLink('admin/master/product', 'Master Data') ?>
        </div>

        <!-- Button Logout -->
        <div class="hidden md:flex">
            <a href="<?= base_url('logout') ?>" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition">
                Logout
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-btn" class="md:hidden text-gray-700 focus:outline-none">
            <i class="fa fa-bars text-2xl"></i>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white shadow-md p-4">
        <a href="<?= base_url('home') ?>" class="block py-2 text-gray-700 hover:text-sky-600">Home</a>

        <!-- Pipeline Dropdown -->
        <div class="relative">
            <button class="w-full text-left py-2 text-gray-700 hover:text-sky-600" id="mobile-dropdown-btn">
                Pipeline <i class="fa fa-chevron-down float-right"></i>
            </button>
            <div id="mobile-dropdown" class="hidden bg-gray-50 mt-1 rounded-md shadow-inner">
                <a href="<?= base_url('pipeline') ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Data Pipeline</a>
                <a href="<?= base_url('pipeline/visit') ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Visit Pipeline</a>
                <a href="<?= base_url('pipeline/closing') ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Closing Pipeline</a>
            </div>
        </div>

        <!-- Performance Dropdown -->
        <div class="relative mt-2">
            <button class="w-full text-left py-2 text-gray-700 hover:text-sky-600" id="mobile-performance-btn">
                Performance <i class="fa fa-chevron-down float-right"></i>
            </button>
            <div id="mobile-performance-dropdown" class="hidden bg-gray-50 mt-1 rounded-md shadow-inner">
                <a href="<?= base_url('performance/target') ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Target</a>
                <a href="<?= base_url('performance/actual') ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Actual</a>
                <a href="<?= base_url('performance/scorecard') ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Scorecard</a>
            </div>
        </div>

        <a href="<?= base_url('admin/master/product') ?>" class="block py-2 text-gray-700 hover:text-sky-600">Master Data</a>
        <a href="<?= base_url('logout') ?>" class="block mt-2 bg-red-500 text-white px-4 py-2 rounded-md text-center hover:bg-red-600 transition">
            Logout
        </a>
    </div>
</nav>

<script>
    // Toggle mobile menu
    document.getElementById('mobile-menu-btn').addEventListener('click', function () {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });

    // Toggle mobile dropdown Pipeline
    document.getElementById('mobile-dropdown-btn').addEventListener('click', function () {
        document.getElementById('mobile-dropdown').classList.toggle('hidden');
    });

    // Toggle mobile dropdown Performance
    document.getElementById('mobile-performance-btn').addEventListener('click', function () {
        document.getElementById('mobile-performance-dropdown').classList.toggle('hidden');
    });
</script>
