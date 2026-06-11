<?php

include 'sugar/heartlink.php';

$query = mysqli_query(
    $heart,
    "SELECT sparkles.*, babes.nama
     FROM sparkles
     JOIN babes
     ON sparkles.babe_id = babes.id
     ORDER BY sparkles.created_at DESC"
);

?>

<?php include 'cotton/snippets/crown.php'; ?>

<title>MyTube</title>

<body class="bg-gradient-to-br from-pink-50 to-white dark:from-zinc-950 dark:to-zinc-900 min-h-screen text-zinc-800 dark:text-zinc-100 transition-colors duration-500 antialiased selection:bg-pink-500 selection:text-white">

<?php include 'cotton/snippets/ribbon.php'; ?>

<section class="text-center mt-16 px-6">

    <h2 class="text-5xl font-extrabold tracking-tight text-pink-500">
        Welcome to MyTube
    </h2>

    <p class="mt-4 text-zinc-500 dark:text-zinc-400 font-medium text-lg max-w-md mx-auto">
        by Nur Islami Sabila
    </p>

</section>

<section class="max-w-7xl mx-auto px-6 mt-16 mb-20">

    <div class="flex items-center gap-2 mb-8">
        <h3 class="text-2xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100">
            Latest Videos
        </h3>
        <span class="flex h-2 w-2 relative mt-1">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pink-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 bg-pink-500"></span>
        </span>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

        <?php while($video = mysqli_fetch_assoc($query)): ?>

            <div class="group bg-white dark:bg-zinc-800/70 rounded-3xl shadow-sm hover:shadow-xl border border-zinc-100 dark:border-zinc-700/30 overflow-hidden transform hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">

                <a href="pretty/watching.php?id=<?= $video['id'] ?>" class="block relative overflow-hidden aspect-video w-full bg-pink-500 flex items-center justify-center transition-all duration-300 select-none">
                    
                    <?php 
                        // Menggunakan ID video untuk membagi jenis love agar bentuknya bervariasi secara otomatis
                        $loveSeed = isset($video['id']) ? (int)$video['id'] % 4 : rand(0, 3);
                        
                        if ($loveSeed === 0): 
                    ?>
                        <svg class="w-14 h-14 text-white transform group-hover:scale-110 transition duration-500 filter drop-shadow-md" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>

                    <?php elseif ($loveSeed === 1): ?>
                        <div class="relative flex items-center justify-center">
                            <svg class="w-14 h-14 text-white transform group-hover:scale-110 transition duration-500 filter drop-shadow-md" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            <svg class="w-6 h-6 text-pink-200 absolute -top-1 -right-2 animate-pulse" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l-1.5-4.5L3 6l4.5-1.5L9 0l1.5 4.5L15 6l-4.5 1.5L9 12z"/>
                            </svg>
                        </div>

                    <?php elseif ($loveSeed === 2): ?>
                        <svg class="w-14 h-14 text-white animate-pulse transform group-hover:scale-110 transition duration-500 filter drop-shadow-md" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>

                    <?php else: ?>
                        <div class="relative w-16 h-16 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white absolute bottom-1 left-1 transform group-hover:translate-x-1 transition duration-500 filter drop-shadow-sm" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            <svg class="w-8 h-8 text-pink-200/90 absolute top-1 right-1 transform group-hover:-translate-y-1 transition duration-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </div>
                    <?php endif; ?>
                    
                    <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                </a>

                <div class="p-5 flex-1 flex flex-col justify-between">

                    <h4 class="font-bold text-base text-zinc-800 dark:text-zinc-100 line-clamp-2 group-hover:text-pink-500 transition-colors duration-200">
                        <?= htmlspecialchars($video['judul']) ?>
                    </h4>

                    <div class="flex items-center gap-2 mt-4 pt-3 border-t border-zinc-50 dark:border-zinc-700/50">
                        <div class="w-6 h-6 rounded-full bg-pink-100 dark:bg-pink-950/50 flex items-center justify-center text-[10px] font-bold text-pink-500 uppercase">
                            <?= mb_substr(htmlspecialchars($video['nama']), 0, 1) ?>
                        </div>
                        <p class="text-xs font-medium text-zinc-500 dark:text-zinc-400 truncate max-w-[150px]">
                            <?= htmlspecialchars($video['nama']) ?>
                        </p>
                    </div>

                </div>

            </div>

        <?php endwhile; ?>

    </div>

</section>

<?php include 'cotton/snippets/footerkiss.php'; ?>