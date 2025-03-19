<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-50 flex justify-center items-center h-screen">

    <div class="bg-white rounded-lg shadow-lg p-8 w-96">
        <h2 class="text-3xl font-semibold text-center text-orange-600 mb-8">Admin Login</h2>

        <form action="/login/authenticate" method="POST" class="space-y-6">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="username" name="username" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
            </div>

            <div>
                <button type="submit" class="w-full py-2 px-4 bg-orange-600 text-white font-semibold rounded-md shadow-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50">
                    Login
                </button>
            </div>
        </form>
    </div>

</body>
</html>
