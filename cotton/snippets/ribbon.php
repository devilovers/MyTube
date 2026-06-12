<nav class="bg-pink-500 text-white px-8 py-4 flex justify-between items-center shadow-lg sticky top-0 z-50 transition-colors duration-300">

    <a href="/mytube/blush.php" class="text-3xl font-black tracking-tight hover:opacity-95 transition active:scale-95 duration-200 flex items-center gap-2 select-none">
        <span class="drop-shadow-sm">💖</span> MyTube V.1
    </a>

    <div class="flex items-center gap-4">

        <?php if(isset($_SESSION['babe_id'])): ?>

            <div class="flex items-center gap-2 bg-black/10 px-3.5 py-1.5 rounded-xl border border-white/5 backdrop-blur-sm select-none">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="text-sm font-semibold tracking-wide">
                    Hi, <?= htmlspecialchars($_SESSION['babe_name']) ?> ✨
                </span>
            </div>

            <div class="relative group">
                <a href="/mytube/pretty/profile.php"
                   title="Profile"
                   class="bg-white/15 text-white border border-white/10 p-2.5 rounded-xl font-semibold hover:bg-white hover:text-pink-500 hover:-translate-y-0.5 active:scale-95 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-center">
                   <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                   </svg>
                </a>
                <span class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 px-2.5 py-1 text-xs font-bold bg-zinc-900/90 text-white rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap shadow-md border border-zinc-700/30 backdrop-blur-sm">
                    Profile
                </span>
            </div>

            <div class="relative group">
                <a href="/mytube/pretty/sparkle.php"
                   title="Upload"
                   class="bg-white/15 text-white border border-white/10 p-2.5 rounded-xl font-semibold hover:bg-white hover:text-pink-500 hover:-translate-y-0.5 active:scale-95 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-center">
                   <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                   </svg>
                </a>
                <span class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 px-2.5 py-1 text-xs font-bold bg-zinc-900/90 text-white rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap shadow-md border border-zinc-700/30 backdrop-blur-sm">
                    Upload
                </span>
            </div>

            <div class="relative group">
                <button
                    id="themeBtn"
                    class="p-2.5 rounded-xl bg-white/15 text-white shadow-sm hover:bg-white hover:text-pink-500 hover:rotate-12 active:scale-95 transition-all duration-300 flex items-center justify-center focus:outline-none border border-white/10 backdrop-blur-md"
                    aria-label="Toggle Theme">
                    <svg id="theme-toggle-sun" class="w-5 h-5 hidden transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <svg id="theme-toggle-moon" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
                <span id="theme-tooltip" class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 px-2.5 py-1 text-xs font-bold bg-zinc-900/90 text-white rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap shadow-md border border-zinc-700/30 backdrop-blur-sm">
                    Switch Mode
                </span>
            </div>

            <div class="relative group">
                <a href="/mytube/glam/bye_babe.php"
                   title="Logout"
                   class="bg-white/15 text-white border border-white/10 p-2.5 rounded-xl font-semibold hover:bg-white hover:text-pink-500 hover:-translate-y-0.5 active:scale-95 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-center">
                   <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                   </svg>
                </a>
                <span class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 px-2.5 py-1 text-xs font-bold bg-zinc-900/90 text-white rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap shadow-md border border-zinc-700/30 backdrop-blur-sm">
                    Logout
                </span>
            </div>

        <?php else: ?>

            <div class="relative group">
                <button
                    id="themeBtn"
                    class="p-2.5 rounded-xl bg-white/15 text-white shadow-sm hover:bg-white/25 hover:rotate-12 active:scale-95 transition-all duration-300 flex items-center justify-center focus:outline-none border border-white/10 backdrop-blur-md"
                    aria-label="Toggle Theme">
                    <svg id="theme-toggle-sun" class="w-5 h-5 hidden transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <svg id="theme-toggle-moon" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
                <span id="theme-tooltip" class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 px-2.5 py-1 text-xs font-bold bg-zinc-900/90 text-white rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap shadow-md border border-zinc-700/30 backdrop-blur-sm">
                    Switch Mode
                </span>
            </div>

            <div class="relative flex items-center bg-black/15 p-1 rounded-2xl backdrop-blur-md border border-white/10 overflow-hidden group/nav">
                
                <div id="auth-highlight" class="absolute top-1 bottom-1 left-1 rounded-xl bg-white shadow-md transition-all duration-300 cubic-bezier(0.4, 0, 0.2, 1) pointer-events-none z-0"></div>

                <a href="/mytube/glam/darling.php"
                   id="btn-login"
                   class="relative px-5 py-2 text-sm font-bold text-white transition-colors duration-300 z-10 select-none text-center min-w-[85px]">
                   Login
                </a>
                
                <a href="/mytube/glam/pinky.php"
                   id="btn-register"
                   class="relative px-5 py-2 text-sm font-bold text-white transition-colors duration-300 z-10 select-none text-center min-w-[85px]">
                   Register
                </a>

            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const highlight = document.getElementById("auth-highlight");
                    const loginBtn = document.getElementById("btn-login");
                    const registerBtn = document.getElementById("btn-register");
                    
                    const currentPath = window.location.pathname;
                    let activeBtn = loginBtn;
                    let inactiveBtn = registerBtn;

                    if (currentPath.includes("pinky.php")) {
                        activeBtn = registerBtn;
                        inactiveBtn = loginBtn;
                    }

                    function setStaticActive(target, active, inactive) {
                        highlight.style.left = target.offsetLeft + "px";
                        highlight.style.width = target.offsetWidth + "px";
                        
                        active.classList.remove("text-white");
                        active.classList.add("text-pink-500");
                        
                        inactive.classList.remove("text-pink-500");
                        inactive.classList.add("text-white");
                    }

                    setTimeout(() => {
                        setStaticActive(activeBtn, activeBtn, inactiveBtn);
                    }, 50);

                    loginBtn.addEventListener("mouseenter", function() {
                        setStaticActive(loginBtn, loginBtn, registerBtn);
                    });

                    registerBtn.addEventListener("mouseenter", function() {
                        setStaticActive(registerBtn, registerBtn, loginBtn);
                    });

                    loginBtn.parentElement.addEventListener("mouseleave", function() {
                        setStaticActive(activeBtn, activeBtn, inactiveBtn);
                    });
                });
            </script>

        <?php endif; ?>

    </div>

</nav>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const themeBtn = document.getElementById("themeBtn");
        const themeTooltip = document.getElementById("theme-tooltip");
        const sunIcon = document.getElementById("theme-toggle-sun");
        const moonIcon = document.getElementById("theme-toggle-moon");

        function updateThemeTooltip() {
            if (!themeTooltip) return;
            
            const isDarkMode = document.documentElement.classList.contains('dark') || 
                               localStorage.getItem('theme') === 'dark';
            
            if (isDarkMode) {
                themeTooltip.textContent = "Switch to Light Mode";
                if (themeBtn) themeBtn.setAttribute('title', "Switch to Light Mode");
            } else {
                themeTooltip.textContent = "Switch to Dark Mode";
                if (themeBtn) themeBtn.setAttribute('title', "Switch to Dark Mode");
            }
        }

        updateThemeTooltip();

        if (themeBtn) {
            themeBtn.addEventListener("click", function() {
                setTimeout(updateThemeTooltip, 50);
            });
        }
    });
</script>