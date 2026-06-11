<nav class="bg-pink-500 text-white px-8 py-4 flex justify-between items-center shadow-lg sticky top-0 z-50 transition-colors duration-300">

    <a href="/mytube/blush.php" class="text-3xl font-black tracking-tight hover:opacity-95 transition active:scale-95 duration-200 flex items-center gap-2 select-none">
        <span class="drop-shadow-sm">💖</span> MyTube V.1
    </a>

    <div class="flex items-center gap-4">

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

        <?php if(isset($_SESSION['babe_id'])): ?>

            <div class="flex items-center gap-2 bg-black/10 px-3.5 py-1.5 rounded-xl border border-white/5 backdrop-blur-sm select-none">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="text-sm font-semibold tracking-wide">
                    Hi, <?= htmlspecialchars($_SESSION['babe_name']) ?> ✨
                </span>
            </div>

            <a href="/mytube/pretty/profile.php"
               class="bg-white/15 text-white border border-white/10 px-4 py-2 rounded-xl font-semibold hover:bg-white hover:text-pink-500 hover:-translate-y-0.5 active:scale-95 shadow-sm hover:shadow-md transition-all duration-300">
               Profile
            </a>

            <a href="/mytube/pretty/sparkle.php"
               class="bg-white/15 text-white border border-white/10 px-4 py-2 rounded-xl font-semibold hover:bg-white hover:text-pink-500 hover:-translate-y-0.5 active:scale-95 shadow-sm hover:shadow-md transition-all duration-300">
               Upload
            </a>

            <a href="/mytube/glam/bye_babe.php"
               class="bg-rose-600/20 text-white border border-rose-500/30 px-4 py-2 rounded-xl font-semibold hover:bg-rose-600 hover:-translate-y-0.5 active:scale-95 shadow-sm hover:shadow-md transition-all duration-300">
               Logout
            </a>

        <?php else: ?>

            <div class="relative flex items-center bg-black/15 p-1 rounded-2xl backdrop-blur-md border border-white/10 overflow-hidden group/nav">
                
                <div id="auth-highlight" class="absolute top-1 bottom-1 left-1 rounded-xl bg-white shadow-md transition-all duration-300 cubic-bezier(0.4, 0, 0.2, 1) pointer-events-none z-0"></div>

                <a href="/mytube/glam/darling.php"
                   id="btn-login"
                   class="relative px-5 py-2 text-sm font-bold text-white transition-colors duration-300 z-10 select-none text-center min-w-[85px]">
                   Login
                </a>
                
                <a href="/mytube/glam/pinky.php"
                   id="btn-register"
                   class="relative px-5 py-2 text-sm font-bold text-pink-500 transition-colors duration-300 z-10 select-none text-center min-w-[85px]">
                   Register
                </a>

            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const highlight = document.getElementById("auth-highlight");
                    const loginBtn = document.getElementById("btn-login");
                    const registerBtn = document.getElementById("btn-register");

                    function updateSlider(target, activeBtn, inactiveBtn) {
                        highlight.style.left = target.offsetLeft + "px";
                        highlight.style.width = target.offsetWidth + "px";
                        
                        activeBtn.classList.remove("text-white");
                        activeBtn.classList.add("text-pink-500");
                        
                        inactiveBtn.classList.remove("text-pink-500");
                        inactiveBtn.classList.add("text-white");
                    }

                    if (registerBtn && highlight) {
                        highlight.style.left = registerBtn.offsetLeft + "px";
                        highlight.style.width = registerBtn.offsetWidth + "px";
                    }

                    loginBtn.addEventListener("mouseenter", function() {
                        updateSlider(loginBtn, loginBtn, registerBtn);
                    });

                    loginBtn.parentElement.addEventListener("mouseleave", function() {
                        updateSlider(registerBtn, registerBtn, loginBtn);
                    });

                    registerBtn.addEventListener("mouseenter", function() {
                        updateSlider(registerBtn, registerBtn, loginBtn);
                    });
                });
            </script>

        <?php endif; ?>

    </div>

</nav>