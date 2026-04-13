<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Management System | Smart Healthcare Platform</title>
    
    @vite(['resources/css/app.css'])
    
    <style>
        /* ===== CUSTOM ANIMATIONS ===== */
        
        /* Floating animation */
        .float {
            animation: float 4s ease-in-out infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        
        /* Slide up animation */
        .slide-up {
            animation: slideUp 0.8s ease forwards;
            opacity: 0;
        }
        
        @keyframes slideUp {
            0% { 
                opacity: 0;
                transform: translateY(30px);
            }
            100% { 
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Animation delays */
        .delay-1 { animation-delay: 0.2s; }
        .delay-2 { animation-delay: 0.4s; }
        .delay-3 { animation-delay: 0.6s; }
        
        /* Hero background with gradient animation */
        .hero-bg {
            background: linear-gradient(135deg, #0f172a, #1e3a8a, #2563eb);
            background-size: 200% 200%;
            animation: gradient 10s ease infinite;
        }
        
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Card hover effects */
        .feature-card {
            transition: all 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* ===== PROFESSIONAL ANIMATIONS FOR HERO TEXT ===== */
        
        /* Fade In Up Animation */
        .fade-up {
            animation: fadeUp 1s ease forwards;
            opacity: 0;
        }
        
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Scale In Animation */
        .scale-in {
            animation: scaleIn 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
            opacity: 0;
            transform: scale(0.8);
        }
        
        @keyframes scaleIn {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        /* Glow Pulse Animation */
        .glow-pulse {
            animation: glowPulseText 2s ease-in-out infinite;
        }
        
        @keyframes glowPulseText {
            0%, 100% {
                text-shadow: 0 0 20px rgba(255, 255, 255, 0.5), 0 0 40px rgba(37, 99, 235, 0.3);
            }
            50% {
                text-shadow: 0 0 30px rgba(255, 255, 255, 0.8), 0 0 60px rgba(37, 99, 235, 0.6);
            }
        }
        
        /* Gradient Shift Animation */
        .gradient-shift {
            background: linear-gradient(90deg, #ffffff, #93c5fd, #ffffff);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientShift 3s linear infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% center; }
            100% { background-position: 200% center; }
        }
        
        /* Badge Pulse Animation */
        .badge-pulse {
            animation: badgePulse 2s ease-in-out infinite;
        }
        
        @keyframes badgePulse {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
            }
            50% {
                box-shadow: 0 0 20px 5px rgba(255, 255, 255, 0.3);
            }
        }
        
        /* Slide In Left Animation */
        .slide-left {
            animation: slideLeft 0.8s ease forwards;
            opacity: 0;
            transform: translateX(-30px);
        }
        
        @keyframes slideLeft {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        /* ===== PERFECT 3D IMAGE EFFECT ===== */
        .image-3d-wrapper {
            position: relative;
            width: fit-content;
            margin: 0 auto;
            transform-style: preserve-3d;
            perspective: 1200px;
        }
        
        .image-3d-container {
            position: relative;
            transform: rotateY(-5deg) rotateX(5deg);
            transition: transform 0.5s ease;
            filter: drop-shadow(0 30px 40px rgba(0, 0, 0, 0.5));
            animation: subtleRotate 8s ease-in-out infinite;
        }
        
        .image-3d-container:hover {
            transform: rotateY(0deg) rotateX(0deg) scale(1.05);
        }
        
        @keyframes subtleRotate {
            0%, 100% { transform: rotateY(-5deg) rotateX(5deg); }
            50% { transform: rotateY(5deg) rotateX(-5deg); }
        }
        
        /* Main image styling */
        .image-3d {
            position: relative;
            width: 280px;
            height: auto;
            border-radius: 30px;
            box-shadow: 
                0 30px 40px -15px rgba(0, 0, 0, 0.6),
                inset 0 -2px 5px rgba(255, 255, 255, 0.2),
                inset 0 2px 5px rgba(255, 255, 255, 0.3);
            transform: translateZ(30px);
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.1);
        }
        
        /* 3D layers */
        .depth-layer-1 {
            position: absolute;
            top: -8px;
            left: -8px;
            right: 8px;
            bottom: 8px;
            background: linear-gradient(145deg, #3b82f6, #1e3a8a);
            border-radius: 35px;
            z-index: -1;
            filter: blur(6px);
            opacity: 0.5;
            transform: translateZ(-10px);
        }
        
        .depth-layer-2 {
            position: absolute;
            top: -15px;
            left: -15px;
            right: 15px;
            bottom: 15px;
            background: linear-gradient(145deg, #2563eb, #0f172a);
            border-radius: 40px;
            z-index: -2;
            filter: blur(10px);
            opacity: 0.4;
            transform: translateZ(-20px);
        }
        
        .depth-layer-3 {
            position: absolute;
            top: -25px;
            left: -25px;
            right: 25px;
            bottom: 25px;
            background: linear-gradient(145deg, #1e3a8a, #0a0f1a);
            border-radius: 45px;
            z-index: -3;
            filter: blur(15px);
            opacity: 0.3;
            transform: translateZ(-30px);
        }
        
        /* Floating particles */
        .particle {
            position: absolute;
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
            opacity: 0.4;
            animation: particleFloat 3s ease-in-out infinite;
            filter: blur(1px);
        }
        
        @keyframes particleFloat {
            0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.4; }
            50% { transform: translate(15px, -15px) scale(1.5); opacity: 0.8; }
        }
        
        .particle-1 { top: 10%; right: 5%; animation-delay: 0s; }
        .particle-2 { top: 30%; right: 15%; animation-delay: 0.5s; }
        .particle-3 { bottom: 20%; right: 10%; animation-delay: 1s; }
        .particle-4 { top: 60%; right: 25%; animation-delay: 1.5s; }
        .particle-5 { bottom: 40%; left: 10%; animation-delay: 2s; }
        
        /* Light reflection */
        .light-reflection {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(
                135deg,
                rgba(255, 255, 255, 0.25) 0%,
                rgba(255, 255, 255, 0.1) 20%,
                rgba(255, 255, 255, 0) 50%,
                rgba(255, 255, 255, 0.05) 80%,
                rgba(255, 255, 255, 0.15) 100%
            );
            border-radius: 30px;
            pointer-events: none;
            z-index: 2;
            mix-blend-mode: overlay;
        }
        
        /* Edge highlight */
        .edge-highlight {
            position: absolute;
            top: 2px;
            left: 2px;
            right: 2px;
            bottom: 2px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 28px;
            pointer-events: none;
            z-index: 3;
            box-shadow: inset 0 0 20px rgba(255, 255, 255, 0.2);
        }
        
        /* 3D badge */
        .badge-3d {
            position: absolute;
            bottom: -15px;
            right: -20px;
            background: linear-gradient(135deg, #2563eb, #1e3a8a);
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.9rem;
            box-shadow: 
                0 15px 25px -8px rgba(0, 0, 0, 0.4),
                0 0 0 2px rgba(255, 255, 255, 0.2);
            transform: rotate(5deg) translateZ(40px);
            z-index: 10;
            animation: badgeFloat 3s ease-in-out infinite;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(5px);
            letter-spacing: 0.5px;
        }
        
        @keyframes badgeFloat {
            0%, 100% { transform: rotate(5deg) translateZ(40px) translateY(0); }
            50% { transform: rotate(5deg) translateZ(40px) translateY(-5px); }
        }
        
        /* Second badge */
        .badge-3d-left {
            position: absolute;
            top: -15px;
            left: -20px;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.8rem;
            box-shadow: 
                0 15px 25px -8px rgba(0, 0, 0, 0.4),
                0 0 0 2px rgba(255, 255, 255, 0.2);
            transform: rotate(-5deg) translateZ(30px);
            z-index: 10;
            animation: badgeFloatLeft 3.5s ease-in-out infinite;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(5px);
        }
        
        @keyframes badgeFloatLeft {
            0%, 100% { transform: rotate(-5deg) translateZ(30px) translateY(0); }
            50% { transform: rotate(-5deg) translateZ(30px) translateY(-5px); }
        }
        
        /* Background glow */
        .glow-background {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, #3b82f6 0%, transparent 70%);
            filter: blur(40px);
            opacity: 0.4;
            z-index: -4;
            animation: glowPulse 4s ease-in-out infinite;
        }
        
        @keyframes glowPulse {
            0%, 100% { opacity: 0.4; transform: translate(-50%, -50%) scale(1); }
            50% { opacity: 0.6; transform: translate(-50%, -50%) scale(1.1); }
        }
        
        /* Pulse animation for CTA */
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        /* Fade in animation */
        .fade-in {
            animation: fadeIn 1s ease forwards;
            opacity: 0;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        /* Rotate on hover */
        .rotate-hover:hover {
            transform: rotate(5deg);
            transition: transform 0.3s ease;
        }
        
        /* ===== LOGO ANIMATION & ENHANCED SIZE ===== */
        .logo-container {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .animated-logo {
            height: 160px;      /* Increased size from 112px to 160px */
            width: auto;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            animation: logoGlowPulse 3s ease-in-out infinite, logoSubtleRotate 6s ease-in-out infinite;
            filter: drop-shadow(0 8px 15px rgba(0, 0, 0, 0.2));
            transform-origin: center;
        }
        
        /* Logo glow & pulse animation */
        @keyframes logoGlowPulse {
            0%, 100% {
                filter: drop-shadow(0 8px 15px rgba(0, 0, 0, 0.2)) brightness(1);
                transform: scale(1);
            }
            50% {
                filter: drop-shadow(0 0 20px rgba(37, 99, 235, 0.5)) brightness(1.08);
                transform: scale(1.02);
            }
        }
        
        /* Gentle rotation for 3D effect */
        @keyframes logoSubtleRotate {
            0%, 100% {
                transform: rotateY(0deg) rotateX(0deg);
            }
            25% {
                transform: rotateY(3deg) rotateX(1deg);
            }
            75% {
                transform: rotateY(-3deg) rotateX(-1deg);
            }
        }
        
        /* Hover effect for logo */
        .animated-logo:hover {
            animation: logoHoverBounce 0.6s ease;
            filter: drop-shadow(0 12px 25px rgba(37, 99, 235, 0.4));
        }
        
        @keyframes logoHoverBounce {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-6px) scale(1.05); }
        }
        
        /* Responsive logo size adjustment */
        @media (max-width: 768px) {
            .animated-logo {
                height: 120px;  /* Slightly smaller on mobile but still large */
            }
        }
        
        /* Adjust navbar padding to accommodate larger logo */
        nav .max-w-7xl {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .image-3d {
                width: 220px;
            }
            
            .depth-layer-1, .depth-layer-2, .depth-layer-3 {
                display: none;
            }
            
            .badge-3d, .badge-3d-left {
                display: none;
            }
        }
    </style>
</head>

<body class="font-sans bg-gray-100 antialiased">

    <!-- ===== NAVBAR WITH ANIMATED LARGER LOGO ===== -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-2 flex justify-between items-center">
            
            <a href="/" class="logo-container">
                <!-- Logo with enhanced size and custom animation -->
                <div class="h-auto w-auto">
                    <img src="{{ asset('logo.png') }}" 
                         alt="Patient Management System Logo" 
                         class="animated-logo">
                </div>
                <!-- Brand text with subtle animation -->
               <span class="hidden sm:inline-block text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-600 font-extrabold text-xl tracking-wide 
             animate-gradient-x hover:scale-105 transition-transform duration-300 
             drop-shadow-[0_2px_4px_rgba(0,0,0,0.1)]">
    Patient<br>
    Management System
</span>
            </a>
            
            <!-- Right Side -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 transition px-3 py-2 rounded-md font-medium">
                    Login
                </a>
                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition shadow-md hover:shadow-lg">
                    Register
                </a>
            </div>

        </div>
    </nav>

    <!-- ===== HERO SECTION WITH PROFESSIONAL ANIMATIONS ===== -->
    <section class="hero-bg text-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-16 md:py-24 grid md:grid-cols-2 gap-10 items-center">
            
            <!-- Left Content with Professional Animations -->
            <div class="space-y-6">
                
                <!-- Badge with pulse animation -->
                <span class="inline-block px-4 py-2 bg-white/10 rounded-full text-sm font-semibold badge-pulse fade-up">
                    ✦ WELCOME TO PATIENT MANAGEMENT SYSTEM ✦
                </span>
                
                <!-- Main heading with professional animations -->
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
                    <span class="block scale-in gradient-shift" style="animation-delay: 0.2s;">
                        Smart Healthcare
                    </span>
                    <span class="block fade-up glow-pulse" style="animation-delay: 0.4s;">
                        Management Platform
                    </span>
                    <span class="block slide-left" style="animation-delay: 0.6s;">
                        Smart Hospital <br> Patient Management System
                    </span>
                </h1>
                
                <p class="text-lg text-gray-200 slide-up delay-1 max-w-lg">
                    Manage patients, doctors, appointments and schedules easily with a
                    modern Laravel based hospital management platform.
                </p>
                
                <div class="flex flex-wrap gap-4 slide-up delay-2">
                    <a href="{{ route('login') }}"
                       class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold 
                              hover:bg-gray-100 transition shadow-lg hover:shadow-xl 
                              inline-flex items-center group pulse">
                        Get Started
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                  stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                    
                    <a href="#features" 
                       class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold 
                              hover:bg-white hover:text-blue-600 transition scale-in" style="animation-delay: 0.8s;">
                        Learn More
                    </a>
                </div>

                <!-- Trust Badges -->
                <div class="flex items-center space-x-4 slide-up delay-3">
                    <div class="flex -space-x-2">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" 
                             class="w-8 h-8 rounded-full border-2 border-white float" style="animation-delay: 0s;">
                        <img src="https://randomuser.me/api/portraits/men/46.jpg" 
                             class="w-8 h-8 rounded-full border-2 border-white float" style="animation-delay: 0.2s;">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" 
                             class="w-8 h-8 rounded-full border-2 border-white float" style="animation-delay: 0.4s;">
                    </div>
                    <p class="text-sm text-gray-200 fade-up" style="animation-delay: 0.9s;">
                        <span class="font-bold">1000+</span> trusted patients
                    </p>
                </div>
            </div>

            <!-- Right Side with 3D IMAGE -->
            <div class="flex justify-center md:justify-end relative">
                <!-- 3D Image Wrapper -->
                <div class="image-3d-wrapper">
                    <!-- Background glow -->
                    <div class="glow-background"></div>
                    
                    <!-- Floating particles -->
                    <div class="particle particle-1"></div>
                    <div class="particle particle-2"></div>
                    <div class="particle particle-3"></div>
                    <div class="particle particle-4"></div>
                    <div class="particle particle-5"></div>
                    
                    <!-- Main 3D Image Container -->
                    <div class="image-3d-container">
                        <!-- Depth layers for 3D effect -->
                        <div class="depth-layer-3"></div>
                        <div class="depth-layer-2"></div>
                        <div class="depth-layer-1"></div>
                        
                        <!-- Main image -->
                        <img src="{{ asset('Doctor.png') }}" 
                             alt="Doctor illustration"
                             class="image-3d scale-in" style="animation-delay: 1s;">
                        
                        <!-- Light reflection overlay -->
                        <div class="light-reflection"></div>
                        
                        <!-- Edge highlight -->
                        <div class="edge-highlight"></div>
                    </div>
                    
                    <!-- 3D Badges -->
                    <div class="badge-3d fade-up" style="animation-delay: 1.2s;">
                        ⚕️ 24/7 Available
                    </div>
                    
                    <div class="badge-3d-left fade-up" style="animation-delay: 1.4s;">
                        ⭐ 5 Star Rated
                    </div>
                </div>
            </div>
        </div>

        <!-- Wave Divider -->
        <div class="relative">
            <svg class="absolute bottom-0 w-full h-12 text-gray-100 fill-current" 
                 viewBox="0 0 1440 100" preserveAspectRatio="none">
                <path d="M0,50 C150,100 350,0 500,50 C650,100 800,0 950,50 C1100,100 1300,0 1440,50 L1440,100 L0,100 Z"></path>
            </svg>
        </div>
    </section>

    <!-- ===== FEATURES SECTION ===== -->
    <section id="features" class="py-20 md:py-24 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            
            <!-- Section Header -->
            <div class="text-center mb-16 fade-in">
                <span class="text-blue-600 font-semibold text-sm uppercase tracking-wider">
                    ✦ Features ✦
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2">
                    Everything You Need in One Place
                </h2>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">
                    Streamline your hospital operations with our comprehensive management tools
                </p>
            </div>
            
            <!-- Features Grid -->
            <div class="grid md:grid-cols-3 gap-8">
                
                <!-- Card 1 -->
                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg text-center group">
                    <div class="w-16 h-16 mx-auto mb-6 flex items-center justify-center 
                                rounded-full bg-blue-100 text-blue-600 text-3xl 
                                group-hover:scale-110 group-hover:rotate-6 transition">
                        👨‍⚕️
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">
                        Patient Management
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        Add, edit and manage patient records easily with a simple and intuitive dashboard interface.
                    </p>
                    
                    <!-- Feature List -->
                    <ul class="mt-4 text-sm text-gray-500 space-y-1">
                        <li class="flex items-center justify-center">
                            <span class="text-green-500 mr-2">✓</span> Digital records
                        </li>
                        <li class="flex items-center justify-center">
                            <span class="text-green-500 mr-2">✓</span> Medical history
                        </li>
                        <li class="flex items-center justify-center">
                            <span class="text-green-500 mr-2">✓</span> Prescriptions
                        </li>
                    </ul>
                </div>

                <!-- Card 2 -->
                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg text-center group">
                    <div class="w-16 h-16 mx-auto mb-6 flex items-center justify-center 
                                rounded-full bg-green-100 text-green-600 text-3xl 
                                group-hover:scale-110 group-hover:rotate-6 transition">
                        📅
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">
                        Doctor Scheduling
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        Manage doctor schedules and appointments efficiently with real-time updates and calendar views.
                    </p>
                    
                    <ul class="mt-4 text-sm text-gray-500 space-y-1">
                        <li class="flex items-center justify-center">
                            <span class="text-green-500 mr-2">✓</span> Appointment booking
                        </li>
                        <li class="flex items-center justify-center">
                            <span class="text-green-500 mr-2">✓</span> Schedule conflicts
                        </li>
                        <li class="flex items-center justify-center">
                            <span class="text-green-500 mr-2">✓</span> Availability tracking
                        </li>
                    </ul>
                </div>

                <!-- Card 3 -->
                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg text-center group">
                    <div class="w-16 h-16 mx-auto mb-6 flex items-center justify-center 
                                rounded-full bg-purple-100 text-purple-600 text-3xl 
                                group-hover:scale-110 group-hover:rotate-6 transition">
                        🔔
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">
                        Smart Notifications
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        Receive instant alerts for patient updates, schedule changes, and important reminders.
                    </p>
                    
                    <ul class="mt-4 text-sm text-gray-500 space-y-1">
                        <li class="flex items-center justify-center">
                            <span class="text-green-500 mr-2">✓</span> SMS/Email alerts
                        </li>
                        <li class="flex items-center justify-center">
                            <span class="text-green-500 mr-2">✓</span> Appointment reminders
                        </li>
                        <li class="flex items-center justify-center">
                            <span class="text-green-500 mr-2">✓</span> Emergency alerts
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== STATS SECTION ===== -->
    <section class="bg-blue-600 py-16 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <pattern id="pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                    <circle cx="10" cy="10" r="2" fill="white"/>
                </pattern>
                <rect x="0" y="0" width="100%" height="100%" fill="url(#pattern)"/>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center text-white">
                <div class="fade-in">
                    <div class="text-4xl font-bold">500+</div>
                    <div class="text-blue-100 mt-2">Happy Patients</div>
                </div>
                <div class="fade-in delay-1">
                    <div class="text-4xl font-bold">50+</div>
                    <div class="text-blue-100 mt-2">Expert Doctors</div>
                </div>
                <div class="fade-in delay-2">
                    <div class="text-4xl font-bold">1000+</div>
                    <div class="text-blue-100 mt-2">Appointments</div>
                </div>
                <div class="fade-in delay-3">
                    <div class="text-4xl font-bold">24/7</div>
                    <div class="text-blue-100 mt-2">Support Available</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CTA SECTION ===== -->
   
   <br>

    <!-- ===== FOOTER ===== -->
    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            
            <!-- Main Footer -->
            <div class="grid md:grid-cols-4 gap-10 mb-12">
                
                <!-- About -->
                <div class="col-span-1 md:col-span-1">
                    <h3 class="text-xl font-semibold mb-4 flex items-center">
                        <span class="text-2xl mr-2 animate-pulse">🏥</span>
                        Patient System
                    </h3>
                    <p class="text-gray-400 leading-relaxed">
                        Smart hospital management platform to manage patients, doctors, 
                        appointments and notifications easily.
                    </p>
                    
                    <!-- Social Links -->
                    <div class="flex space-x-4 mt-6">
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <span class="sr-only">Facebook</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <span class="sr-only">Twitter</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <span class="sr-only">LinkedIn</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Services</a></li>
                        <li><a href="#" class="hover:text-white transition">Doctors</a></li>
                        <li><a href="#" class="hover:text-white transition">Appointments</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-start">
                            <span class="mr-2">📍</span>
                            Mumbai, India - 400001
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">📞</span>
                            +91 88734 63079
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">✉</span>
                            <a href="mailto:support@patientsystem.com" class="hover:text-white transition">
                                support@patientsystem.com
                            </a>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">🕒</span>
                            Mon-Sat: 9:00 AM - 8:00 PM
                        </li>
                    </ul>
                </div>

                <!-- Google Map -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Our Location</h3>
                    <div class="rounded-lg overflow-hidden shadow-lg">
                        <iframe
                            class="w-full h-40"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d241317.11609823277!2d72.74109995709657!3d19.08219783958221!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c6306644edc1%3A0x5da4ed8f8d648c69!2sMumbai%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1709812345678!5m2!1sen!2sin"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Map showing Mumbai location">
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-800 pt-8 mt-8 text-center text-gray-500">
                <p>© {{ date('Y') }} Patient Management System. All rights reserved.</p>
                <p class="text-sm mt-2">
                    <a href="#" class="hover:text-gray-400 transition">Privacy Policy</a> • 
                    <a href="#" class="hover:text-gray-400 transition">Terms of Service</a> •
                    <a href="#" class="hover:text-gray-400 transition">Cookie Policy</a>
                </p>
            </div>
        </div>
    </footer>

    <!-- ===== JAVASCRIPT FOR ADDITIONAL EFFECTS ===== -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // 3D image mouse follow effect
            const imageContainer = document.querySelector('.image-3d-container');
            const wrapper = document.querySelector('.image-3d-wrapper');
            
            if (imageContainer && window.innerWidth > 768) {
                wrapper.addEventListener('mousemove', function(e) {
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    
                    const rotateX = (y - centerY) / 20;
                    const rotateY = (centerX - x) / 20;
                    
                    imageContainer.style.transform = `rotateY(${rotateY}deg) rotateX(${rotateX}deg) scale(1.02)`;
                });
                
                wrapper.addEventListener('mouseleave', function() {
                    imageContainer.style.transform = 'rotateY(-5deg) rotateX(5deg) scale(1)';
                });
            }
        });
    </script>
</body>
</html>