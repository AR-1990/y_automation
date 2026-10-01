<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Sports Media</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FAFAFA;
            color: #0F172A;
            overflow-x: hidden;
        }

        /* Unique Organic Background Shapes */
        .bg-shape {
            position: absolute;
            filter: blur(100px);
            z-index: -1;
            opacity: 0.6;
            animation: drift 15s ease-in-out infinite alternate;
        }
        .shape-1 { background: #E0E7FF; width: 600px; height: 600px; top: -100px; left: -100px; border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%; }
        .shape-2 { background: #FCE7F3; width: 500px; height: 500px; bottom: 0; right: -50px; border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
        .shape-3 { background: #FEF08A; width: 400px; height: 400px; top: 30%; left: 30%; border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; animation-duration: 20s; }

        @keyframes drift {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(30px, -50px) rotate(20deg); }
        }

        /* Glassmorphism Navigation */
        .nav-glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
        }

        /* Custom Soft Shadow */
        .soft-shadow {
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.05);
        }

        /* Animated Gradient Text */
        .text-gradient {
            background: linear-gradient(135deg, #2563EB, #7C3AED, #DB2777);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: 200% 200%;
            animation: gradient-shift 5s ease infinite;
        }

        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Clean Modern Card */
        .feature-card {
            background: #FFFFFF;
            border: 1px solid #F1F5F9;
            border-radius: 24px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }
        
        .feature-card::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, #2563EB, #7C3AED);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
            border-color: transparent;
        }
        
        .feature-card:hover::after {
            transform: scaleX(1);
        }

        /* Micro-interaction Button */
        .btn-modern {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .btn-modern::before {
            content: '';
            position: absolute;
            top: 50%; left: 50%;
            width: 300px; height: 300px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: transform 0.5s ease;
        }
        .btn-modern:hover::before {
            transform: translate(-50%, -50%) scale(1);
        }

        /* Live Pulse Dot */
        .pulse-dot {
            width: 8px; height: 8px;
            background-color: #10B981;
            border-radius: 50%;
            position: relative;
        }
        .pulse-dot::after {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            border: 2px solid #10B981;
            animation: ripple 1.5s infinite ease-out;
        }
        @keyframes ripple {
            0% { transform: scale(0.5); opacity: 1; }
            100% { transform: scale(2); opacity: 0; }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col relative">

    <!-- Organic Backgrounds -->
    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>
    <div class="bg-shape shape-3"></div>

    <!-- Navigation -->
    <nav class="nav-glass fixed w-full top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-black rounded-xl flex items-center justify-center shadow-lg">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M2 17L12 22L22 17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M2 12L12 17L22 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span class="font-extrabold text-xl tracking-tight text-gray-900">AISM</span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-10 font-medium text-sm text-gray-600">
                    <a href="#" class="hover:text-black transition">Overview</a>
                    <a href="#" class="hover:text-black transition">Workflows</a>
                    <a href="#" class="hover:text-black transition">Library</a>
                </div>

                <!-- Admin Action -->
                <div class="flex items-center gap-4">
                    <div class="hidden sm:flex items-center gap-2 bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100 text-xs font-semibold text-gray-700">
                        <div class="pulse-dot"></div>
                        System Idle
                    </div>
                    <a href="{{ route('login') }}" class="btn-modern bg-black text-white px-6 py-2.5 rounded-full font-semibold text-sm shadow-[0_10px_20px_rgba(0,0,0,0.1)] hover:shadow-[0_15px_30px_rgba(0,0,0,0.15)] hover:-translate-y-0.5 transition-all">
                        Admin Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow pt-32 pb-20 px-6 flex flex-col items-center relative z-10">
        
        <!-- Hero Section -->
        <div class="max-w-4xl w-full text-center mt-12 md:mt-20 mb-24">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-gray-200 shadow-sm text-xs font-bold text-gray-500 mb-8 uppercase tracking-widest">
                <i class="fas fa-sparkles text-blue-500"></i> Next-Gen Media Automation
            </div>
            
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-gray-900 mb-6 leading-[1.1]">
                Highlights engineered by <br class="hidden md:block"/>
                <span class="text-gradient">Artificial Intelligence.</span>
            </h1>
            
            <p class="text-lg md:text-xl text-gray-500 font-medium max-w-2xl mx-auto leading-relaxed mb-10">
                Connect CricClubs with YouTube Live. Our autonomous engine clips, renders, and stages viral moments for social media before the next ball is bowled.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button class="bg-black text-white px-8 py-4 rounded-2xl font-bold text-base shadow-[0_10px_20px_rgba(0,0,0,0.1)] hover:bg-gray-800 transition transform hover:-translate-y-1 flex items-center justify-center gap-2">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                    Start Engine
                </button>
                <button class="bg-white text-gray-900 border border-gray-200 px-8 py-4 rounded-2xl font-bold text-base shadow-sm hover:border-gray-300 hover:bg-gray-50 transition flex items-center justify-center gap-2">
                    View Dashboard
                </button>
            </div>
        </div>

        <!-- Workflow Section (Bento Grid Style) -->
        <div class="max-w-6xl w-full grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Large Card: Sync -->
            <div class="feature-card md:col-span-2 p-8 md:p-10 flex flex-col justify-between min-h-[300px]">
                <div>
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl mb-6">
                        <i class="fas fa-satellite-dish"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Live Synchronization</h3>
                    <p class="text-gray-500 font-medium leading-relaxed max-w-md">
                        The system hooks into CricClubs API, detects high-priority events, and precisely locates the corresponding timestamp in the YouTube Live feed.
                    </p>
                </div>
                <div class="mt-8 flex gap-3 text-xs font-semibold text-gray-400">
                    <span class="bg-gray-100 px-3 py-1 rounded-lg">Webhook</span>
                    <span class="bg-gray-100 px-3 py-1 rounded-lg">Stream Extraction</span>
                </div>
            </div>

            <!-- Small Card: Render -->
            <div class="feature-card p-8 flex flex-col justify-between min-h-[300px]">
                <div>
                    <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center text-xl mb-6">
                        <i class="fas fa-wand-magic-sparkles"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">AI Processing</h3>
                    <p class="text-gray-500 font-medium leading-relaxed">
                        FFmpeg automatically reframes to 9:16, trims dead air, and applies branded overlays instantly.
                    </p>
                </div>
            </div>

            <!-- Small Card: Approval -->
            <div class="feature-card p-8 flex flex-col justify-between min-h-[300px]">
                <div>
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-xl mb-6">
                        <i class="fas fa-check-double"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">One-Click Approval</h3>
                    <p class="text-gray-500 font-medium leading-relaxed">
                        Clips are staged in the admin panel. Review, edit auto-captions, and approve for publishing.
                    </p>
                </div>
            </div>

            <!-- Large Card: Social -->
            <div class="feature-card md:col-span-2 p-8 md:p-10 flex flex-col justify-between min-h-[300px] bg-gradient-to-br from-gray-900 to-black text-white border-none">
                <div>
                    <div class="w-12 h-12 bg-white/10 text-white rounded-2xl flex items-center justify-center text-xl mb-6 backdrop-blur-md">
                        <i class="fab fa-instagram"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Zero-Touch Publishing</h3>
                    <p class="text-gray-300 font-medium leading-relaxed max-w-md">
                        Approved moments are automatically deployed to Instagram Reels and Facebook with AI-generated hashtags. Post-match highlight reels are compiled autonomously.
                    </p>
                </div>
                <div class="mt-8 flex gap-3 text-xs font-semibold text-gray-400">
                    <span class="bg-white/10 px-3 py-1 rounded-lg">Graph API</span>
                    <span class="bg-white/10 px-3 py-1 rounded-lg">Highlight Compiler</span>
                </div>
            </div>

        </div>
    </main>

    <!-- Minimal Footer -->
    <footer class="border-t border-gray-200 bg-white py-8 mt-auto z-10 relative">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 bg-black rounded-md flex items-center justify-center">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="white" stroke-width="3" stroke-linejoin="round"/>
                    </svg>
                </div>
                <span class="font-bold text-sm text-gray-900">AISM</span>
            </div>
            <p class="text-sm font-medium text-gray-500">
                Koder360 © 2026. All rights reserved.
            </p>
        </div>
    </footer>

</body>
</html>
