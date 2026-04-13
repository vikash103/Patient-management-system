<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Medical Login | Split Layout</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome 6 (optional icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Global reset: no margin, no overflow */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            overflow: hidden;
            height: 100vh;
            width: 100vw;
        }
        /* Smooth transition for button */
        .btn-gradient {
            transition: all 0.3s ease;
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.2);
        }
        /* Custom focus ring for inputs */
        input:focus {
            outline: none;
            ring: 2px solid #3b82f6;
            ring-offset: 2px;
        }
    </style>
</head>
<body>
    <!-- Main split container (full viewport) -->
    <div class="flex flex-col md:flex-row h-screen w-full">
        
        <!-- LEFT SECTION (50% width, full height) -->
        <div class="w-full md:w-1/2 h-full bg-gradient-to-br from-indigo-600 to-purple-700 flex items-center justify-center p-6">
            <div class="text-center text-white max-w-md">
                <h1 class="text-3xl md:text-4xl font-bold mb-4">Medical Excellence</h1>
                <p class="text-base md:text-lg opacity-90 mb-8">
                    Join our team of dedicated professionals committed to exceptional patient care.
                </p>
                <div class="flex flex-wrap justify-center gap-3">
                    <div class="bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 text-sm font-medium">
                        <i class="fas fa-shield-alt mr-2"></i> Trusted Care
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 text-sm font-medium">
                        <i class="fas fa-user-md mr-2"></i> Expert Staff
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT SECTION (50% width, full height) -->
        <div class="w-full md:w-1/2 h-full bg-gray-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 md:p-8">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Welcome Back</h2>
                    <p class="text-gray-500 text-sm mt-1">Login to your account</p>
                </div>

                <form action="#" method="POST" class="space-y-5">
                     @csrf
                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" id="email" name="email" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                               placeholder="doctor@hospital.com">
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" id="password" name="password" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                               placeholder="••••••••">
                    </div>

                    <!-- Remember Me & Forgot Password Row -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <span class="text-sm text-gray-600">Remember me</span>
                        </label>
                        <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800 transition">Forgot password?</a>
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                            class="btn-gradient w-full bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-semibold py-2.5 rounded-lg shadow-md transition duration-200">
                        Log in
                    </button>

                    <!-- Optional Sign Up Link -->
                    <div class="text-center text-sm text-gray-600 mt-4">
                        Don't have an account?
                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-800 transition">Sign up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>