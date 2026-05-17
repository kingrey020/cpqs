<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- REMOVED THE ANNOYING META REFRESH! Replaced with invisible JS below -->
    
    <title>Live Queue Display - Medicenter</title>
    
    <!-- Modern Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            900: '#1e3a8a',
                        },
                        tv: {
                            bg: '#030712', /* Ultra dark sleek background */
                            card: '#0f172a',
                        }
                    },
                    animation: {
                        'pulse-glow': 'pulseGlow 2.5s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float-slow': 'float 8s ease-in-out infinite',
                        'float-delayed': 'float 10s ease-in-out 4s infinite',
                        'slide-in': 'slideIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                    },
                    keyframes: {
                        pulseGlow: {
                            '0%, 100%': { opacity: 1, transform: 'scale(1)', filter: 'brightness(1)' },
                            '50%': { opacity: .85, transform: 'scale(1.02)', filter: 'brightness(1.2)' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0) scale(1)' },
                            '50%': { transform: 'translateY(-30px) scale(1.05)' },
                        },
                        slideIn: {
                            '0%': { opacity: 0, transform: 'translateX(30px)' },
                            '100%': { opacity: 1, transform: 'translateX(0)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #030712; 
        }
        
        /* High-tech grid background */
        .bg-grid-pattern {
            background-image: 
                linear-gradient(to right, rgba(59, 130, 246, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(59, 130, 246, 0.05) 1px, transparent 1px);
            background-size: 40px 40px;
            background-position: center center;
        }

        /* Premium Glassmorphism */
        .glass-panel {
            background: linear-gradient(145deg, rgba(15, 23, 42, 0.8) 0%, rgba(3, 7, 18, 0.95) 100%);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.03);
            border-top: 1px solid rgba(255, 255, 255, 0.08); /* Highlight edge */
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
        }

        /* Intense glowing shadow for the big number */
        .neon-text-shadow {
            text-shadow: 0 0 60px rgba(59, 130, 246, 0.6), 0 0 20px rgba(59, 130, 246, 0.4);
        }

        /* Smooth scrollbar for mobile viewing */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(59, 130, 246, 0.3); border-radius: 4px; }
    </style>
</head>
<body class="text-slate-200 antialiased min-h-screen w-full flex flex-col relative overflow-x-hidden">

    <!-- Floating Background Orbs -->
    <div class="fixed inset-0 z-[-1] pointer-events-none overflow-hidden">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] lg:w-[800px] lg:h-[800px] bg-brand-600/20 rounded-full mix-blend-screen filter blur-[100px] lg:blur-[150px] animate-float-slow"></div>
        <div class="absolute bottom-[-10%] right-[-5%] w-[400px] h-[400px] lg:w-[700px] lg:h-[700px] bg-emerald-500/15 rounded-full mix-blend-screen filter blur-[90px] lg:blur-[120px] animate-float-delayed"></div>
    </div>

    <!-- Header / Nav -->
    <header class="flex-none flex items-center justify-between px-5 lg:px-10 py-5 lg:py-6 glass-panel border-b-0 border-slate-800/50 z-20">
        <div class="flex items-center gap-4 lg:gap-5">
            <div class="w-12 h-12 lg:w-16 lg:h-16 bg-gradient-to-br from-brand-400 to-brand-700 rounded-xl lg:rounded-2xl flex items-center justify-center shadow-[0_0_30px_rgba(59,130,246,0.3)] border border-white/10">
                <svg class="w-7 h-7 lg:w-9 lg:h-9 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </div>
            <div class="flex flex-col justify-center">
                <h1 class="text-2xl lg:text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400 tracking-tight leading-none mb-1">Medicenter</h1>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <p class="text-emerald-400 font-bold tracking-[0.2em] uppercase text-[10px] lg:text-xs">Live Outpatient Queue</p>
                </div>
            </div>
        </div>
        
        <!-- Live Clock -->
        <div class="text-right flex flex-col justify-center">
            <div id="clock-time" class="text-3xl lg:text-5xl font-black text-white tracking-tighter tabular-nums leading-none mb-1">00:00</div>
            <div id="clock-date" class="text-brand-400 font-bold text-[10px] lg:text-sm tracking-[0.15em] uppercase">Loading...</div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main id="queue-main-content" class="flex-grow flex flex-col lg:flex-row gap-6 lg:gap-8 p-5 lg:p-10 z-10">
        
        <!-- Left Side: Now Serving (Hero Section) -->
        <div class="w-full lg:w-2/3 glass-panel rounded-[2rem] lg:rounded-[3rem] flex flex-col items-center justify-center relative overflow-hidden py-16 lg:py-0 border border-slate-800">
            
            <!-- Tech Grid Overlay -->
            <div class="absolute inset-0 bg-grid-pattern opacity-50"></div>
            
            @if($currentCalled)
                <!-- Active Glowing Core -->
                <div class="absolute inset-0 bg-gradient-to-b from-brand-500/10 via-transparent to-transparent"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-3/4 h-3/4 bg-brand-500/10 rounded-full blur-[100px]"></div>
                
                <div class="animate-pulse-glow flex flex-col items-center relative z-10 w-full px-4">
                    
                    <!-- Neon Badge -->
                    <div class="inline-flex items-center gap-3 px-6 py-2 lg:px-8 lg:py-3 rounded-full bg-emerald-500/10 border border-emerald-400/30 shadow-[0_0_20px_rgba(16,185,129,0.2)] backdrop-blur-sm mb-6 lg:mb-10">
                        <span class="relative flex h-3 w-3 lg:h-4 lg:w-4">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-3 w-3 lg:h-4 lg:w-4 bg-emerald-500 shadow-[0_0_10px_#10b981]"></span>
                        </span>
                        <h2 class="text-emerald-400 text-sm lg:text-xl font-black tracking-[0.3em] uppercase">Now Serving</h2>
                    </div>

                    <!-- Holographic Massive Number -->
                    <div class="text-[9rem] sm:text-[12rem] lg:text-[18rem] leading-[0.8] font-black text-transparent bg-clip-text bg-gradient-to-b from-white via-slate-100 to-slate-400 neon-text-shadow tracking-tighter text-center">
                        {{ $currentCalled->queue_number }}
                    </div>
                    
                    <!-- Instruction text -->
                    <div class="mt-8 lg:mt-12 bg-slate-900/50 border border-slate-700/50 px-8 py-4 rounded-2xl backdrop-blur-md">
                        <p class="text-slate-300 text-base lg:text-2xl font-bold tracking-wide text-center">
                            Please proceed to <span class="text-brand-400">Counter 1</span>
                        </p>
                    </div>
                </div>
            @else
                <!-- Empty Standby State -->
                <div class="flex flex-col items-center opacity-40 py-10 lg:py-0 relative z-10">
                    <div class="w-24 h-24 lg:w-40 lg:h-40 rounded-full bg-slate-800 flex items-center justify-center mb-6 lg:mb-8 border border-slate-700 shadow-[inset_0_0_30px_rgba(0,0,0,0.5)]">
                        <svg class="w-12 h-12 lg:w-20 lg:h-20 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h2 class="text-2xl lg:text-4xl font-bold text-slate-400 text-center tracking-tight">System on Standby</h2>
                    <p class="text-slate-500 mt-2 text-sm lg:text-lg uppercase tracking-widest">Waiting for next patient</p>
                </div>
            @endif
        </div>

        <!-- Right Side: Next in Line -->
        <div class="w-full lg:w-1/3 flex flex-col">
            <div class="glass-panel rounded-[2rem] lg:rounded-[3rem] p-6 lg:p-8 flex flex-col h-full border border-slate-800 relative overflow-hidden">
                
                <!-- Subtle top gradient line -->
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-600 to-transparent opacity-50"></div>

                <div class="flex items-center gap-3 lg:gap-4 mb-6 lg:mb-8 pb-4 lg:pb-6 border-b border-slate-800">
                    <div class="p-2 lg:p-3 bg-brand-500/10 rounded-xl border border-brand-500/20">
                        <svg class="w-6 h-6 lg:w-8 lg:h-8 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl lg:text-3xl font-black text-white tracking-tight">Next in Line</h3>
                        <p class="text-slate-500 text-xs lg:text-sm font-semibold uppercase tracking-wider">Please prepare your ID</p>
                    </div>
                </div>

                <!-- Animated List -->
                <div class="flex-grow flex flex-col gap-3 lg:gap-4 overflow-hidden relative">
                    
                    <!-- Fade out mask at bottom -->
                    <div class="absolute bottom-0 left-0 w-full h-12 bg-gradient-to-t from-tv-card to-transparent z-10 pointer-events-none"></div>

                    @if(count($nextWaiting) > 0)
                        @foreach($nextWaiting as $index => $entry)
                            <!-- Staggered slide-in animation -->
                            <div class="bg-slate-800/40 border border-slate-700/50 rounded-xl lg:rounded-2xl p-4 lg:p-5 flex items-center justify-between opacity-0 animate-slide-in relative overflow-hidden" style="animation-delay: {{ $index * 100 }}ms;">
                                
                                <!-- Left colored accent bar -->
                                <div class="absolute left-0 top-0 bottom-0 w-1 bg-brand-500 opacity-50"></div>
                                
                                <div class="flex items-center gap-4 lg:gap-6 pl-2 lg:pl-3">
                                    <span class="text-sm lg:text-lg font-bold text-slate-500 tracking-widest uppercase">POS. {{ $index + 1 }}</span>
                                    <span class="text-3xl lg:text-5xl font-black text-white tracking-tighter">{{ $entry->queue_number }}</span>
                                </div>
                                <div class="hidden lg:flex flex-col items-end">
                                    <span class="text-xs text-slate-400 font-medium uppercase tracking-wider">Status</span>
                                    <span class="text-sm text-brand-400 font-bold">Waiting</span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Empty Queue Message -->
                        <div class="flex-grow flex flex-col items-center justify-center text-center opacity-40">
                            <svg class="w-12 h-12 text-slate-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 12h14M12 5l7 7-7 7"></path></svg>
                            <p class="text-sm lg:text-lg text-slate-400 font-bold uppercase tracking-widest">Queue is currently empty</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <!-- News-Style Footer Ticker -->
    <footer class="flex-none bg-slate-900 border-t border-slate-800 flex items-center relative z-20 shadow-[0_-10px_30px_rgba(0,0,0,0.5)]">
        <!-- Static Badge -->
        <div class="bg-brand-600 text-white px-4 lg:px-8 py-2 lg:py-4 font-black tracking-widest uppercase text-[10px] lg:text-sm z-10 shadow-[5px_0_15px_rgba(0,0,0,0.5)] flex items-center gap-2 relative">
            <svg class="w-4 h-4 lg:w-5 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Announcement
        </div>
        
        <!-- Scrolling Text -->
        <div class="overflow-hidden whitespace-nowrap flex-grow flex items-center">
            <p class="text-slate-300 text-xs lg:text-lg font-bold tracking-wide inline-block animate-[marquee_25s_linear_infinite] pl-4">
                Please have your ID and medical records ready before approaching the counter. If you miss your number, kindly notify the reception desk immediately. Thank you for choosing Medicenter.
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Custom Marquee Animation
        document.head.insertAdjacentHTML("beforeend", `<style>
            @keyframes marquee {
                0% { transform: translateX(100%); }
                100% { transform: translateX(-100%); }
            }
        </style>`);

        // Live Clock Feature
        function updateClock() {
            const now = new Date();
            let hours = now.getHours();
            let minutes = now.getMinutes();
            const ampm = hours >= 12 ? 'PM' : 'AM';
            
            hours = hours % 12;
            hours = hours ? hours : 12; 
            minutes = minutes < 10 ? '0' + minutes : minutes;
            
            document.getElementById('clock-time').textContent = `${hours}:${minutes} ${ampm}`;
            
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('clock-date').textContent = now.toLocaleDateString('en-US', options);
        }
        
        setInterval(updateClock, 1000);
        updateClock(); // Init immediately

        // ----------------------------------------------------
        // SILENT INVISIBLE BACKGROUND REFRESH (NO FLASHING)
        // ----------------------------------------------------
        let lastContent = document.getElementById('queue-main-content').innerHTML;

        setInterval(async () => {
            try {
                // Fetch the page silently in the background
                const response = await fetch(window.location.href);
                const htmlText = await response.text();
                
                // Parse the downloaded HTML
                const parser = new DOMParser();
                const doc = parser.parseFromString(htmlText, 'text/html');
                
                // Extract just the main content area
                const newMain = doc.getElementById('queue-main-content');
                
                if (newMain) {
                    const newContent = newMain.innerHTML;
                    
                    // Only update the screen if the queue data actually changed!
                    if (newContent !== lastContent) {
                        document.getElementById('queue-main-content').innerHTML = newContent;
                        lastContent = newContent;
                    }
                }
            } catch (error) {
                console.error("Background sync failed:", error);
            }
        }, 5000); // Checks for updates every 5 seconds invisibly
    </script>
</body>
</html>