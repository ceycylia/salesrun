<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SalesRun</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <nav class="bg-orange-500 shadow sticky top-0 w-full p-0">
        <div class="flex justify-between items-center px-6 py-4">
            <a href="index.html" class="flex items-center text-2xl font-semibold text-white">
                <i class="fa fa-book mr-3"></i> SalesRun
            </a>

            <ul class="flex space-x-16 text-lg">
                <li class="relative group">
                    <a href="<?= base_url('home') ?>" class="text-white hover:text-orange-200">Home</a>
                    <div class="absolute left-0 hidden group-hover:block bg-white shadow-lg mt-2 p-2 w-48">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 whitespace-nowrap">Dummy Home 1</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 whitespace-nowrap">Dummy Home 2</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 whitespace-nowrap">Dummy Home 3</a>
                    </div>
                </li>
                <li class="relative group">
                    <a href="#" class="text-white hover:text-orange-200">About</a>
                    <div class="absolute left-0 hidden group-hover:block bg-white shadow-lg mt-2 p-2 w-48">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 whitespace-nowrap">Dummy About 1</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 whitespace-nowrap">Dummy About 2</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 whitespace-nowrap">Dummy About 3</a>
                    </div>
                </li>
                <li class="relative group">
                    <a href="#" class="text-white hover:text-orange-200">Courses</a>
                    <div class="absolute left-0 hidden group-hover:block bg-white shadow-lg mt-2 p-2 w-48">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 whitespace-nowrap">Dummy Course 1</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 whitespace-nowrap">Dummy Course 2</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 whitespace-nowrap">Dummy Course 3</a>
                    </div>
                </li>
                <li class="relative group">
                    <a href="#" class="text-white hover:text-orange-200">Contact</a>
                    <div class="absolute left-0 hidden group-hover:block bg-white shadow-lg mt-2 p-2 w-48">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 whitespace-nowrap">Dummy Contact 1</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 whitespace-nowrap">Dummy Contact 2</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 whitespace-nowrap">Dummy Contact 3</a>
                    </div>
                </li>
                <li class="relative group">
                    <a href="#" class="text-white hover:text-orange-200">Pages</a>
                    <div class="absolute left-0 hidden group-hover:block bg-white shadow-lg mt-2 p-2 w-48">
                        <a href="team.html" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 whitespace-nowrap">Our Team</a>
                        <a href="testimonial.html" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 whitespace-nowrap">Testimonial</a>
                        <a href="404.html" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 whitespace-nowrap">404 Page</a>
                    </div>
                </li>
            </ul>

            <div class="flex items-center space-x-4">
                <a href="#" class="bg-blue-600 text-white py-2 px-4 rounded-full hover:bg-blue-700 transition duration-300">Join Now <i class="fa fa-arrow-right ml-2"></i></a>
            </div>
        </div>
    </nav>
</body>

</html>