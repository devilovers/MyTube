<?php

include '../sugar/heartlink.php';

if (
    isset($_GET['delete']) &&
    isset($_SESSION['babe_id'])
) {

    $delete_id = (int) $_GET['delete'];

    $stmt = mysqli_prepare(
        $heart,
        "DELETE FROM sparkles
         WHERE id = ?
         AND babe_id = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ii",
        $delete_id,
        $_SESSION['babe_id']
    );

    mysqli_stmt_execute($stmt);

    header("Location: ../blush.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: ../blush.php");
    exit;
}

$id = (int) $_GET['id'];

$stmt = mysqli_prepare(
    $heart,
    "SELECT sparkles.*, babes.nama
     FROM sparkles
     JOIN babes
     ON sparkles.babe_id = babes.id
     WHERE sparkles.id = ?"
);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$video = mysqli_fetch_assoc($result);

if (!$video) {
    header("Location: ../blush.php");
    exit;
}

preg_match(
    '/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/',
    $video['youtube_url'],
    $matches
);

$video_id = $matches[1] ?? '';

?>

<?php include '../cotton/snippets/crown.php'; ?>

<title><?= htmlspecialchars($video['judul']) ?> • MyTube</title>

<body class="bg-gradient-to-br from-pink-50 to-white dark:from-zinc-950 dark:to-zinc-900 min-h-screen text-zinc-800 dark:text-zinc-100 transition-colors duration-500 antialiased flex flex-col justify-between selection:bg-pink-500 selection:text-white">

    <div class="w-full z-50">
        <?php include '../cotton/snippets/ribbon.php'; ?>
    </div>

    <main class="flex-1 max-w-5xl w-full mx-auto px-6 py-12 relative">
        
        <div class="relative group">
            <div class="absolute -inset-1 bg-gradient-to-r from-pink-500 to-rose-400 rounded-3xl blur opacity-25 group-hover:opacity-40 transition duration-1000 group-hover:duration-200"></div>
            <div class="relative aspect-video rounded-3xl overflow-hidden shadow-2xl bg-black border border-zinc-100 dark:border-zinc-800/50">
                <iframe
                    class="w-full h-full"
                    src="https://www.youtube.com/embed/<?= htmlspecialchars($video_id) ?>?rel=0&showinfo=0&modestbranding=1"
                    title="<?= htmlspecialchars($video['judul']) ?>"
                    allowfullscreen>
                </iframe>
            </div>
        </div>

        <div class="mt-8 bg-white/80 dark:bg-zinc-800/60 rounded-3xl shadow-xl border border-zinc-100 dark:border-zinc-700/30 p-6 md:p-8 backdrop-blur-xl transition-all duration-300">
            
            <div class="flex flex-col gap-5">
                <div class="space-y-3">
                    <h1 class="text-2xl md:text-3xl font-black tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-rose-500 drop-shadow-sm">
                        <?= htmlspecialchars($video['judul']) ?>
                    </h1>
                    
                    <div class="flex flex-wrap items-center gap-3">
                        <div class="inline-flex items-center gap-2 bg-pink-50 dark:bg-pink-950/30 px-3.5 py-1.5 rounded-2xl border border-pink-100 dark:border-pink-950/50 text-xs font-bold text-pink-500">
                            <div class="w-5 h-5 rounded-xl bg-pink-500 flex items-center justify-center text-[9px] font-black text-white uppercase">
                                <?= mb_substr(htmlspecialchars($video['nama']), 0, 1) ?>
                            </div>
                            Uploaded by <span class="underline underline-offset-2"><?= htmlspecialchars($video['nama']) ?></span> ✨
                        </div>

                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-2xl bg-zinc-100 dark:bg-zinc-900/50 text-zinc-500 dark:text-zinc-400 font-bold text-[10px] uppercase tracking-wider border border-zinc-200/40 dark:border-zinc-800/30">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> MyTube Studio Player
                        </span>
                    </div>
                </div>

                <?php if (
                    isset($_SESSION['babe_id']) &&
                    $_SESSION['babe_id'] == $video['babe_id']
                ): ?>
                    <div class="flex items-center gap-3 pt-2 border-t border-zinc-100 dark:border-zinc-800/50">
                        <a
                            href="vanity.php?id=<?= $video['id'] ?>"
                            class="inline-flex items-center gap-2 bg-zinc-100 hover:bg-pink-50 dark:bg-zinc-900/50 dark:hover:bg-pink-950/20 text-zinc-700 dark:text-zinc-300 hover:text-pink-500 dark:hover:text-pink-400 border border-zinc-200 dark:border-zinc-700/50 px-5 py-2.5 rounded-2xl font-bold text-xs tracking-wide shadow-sm active:scale-95 transition-all duration-300">
                            ✏️ Edit Title
                        </a>

                        <a
                            href="watching.php?delete=<?= $video['id'] ?>"
                            onclick="return confirm('Yakin ingin menghapus video ini?');"
                            class="inline-flex items-center gap-2 bg-rose-500/10 hover:bg-rose-600 text-rose-500 hover:text-white border border-rose-500/20 px-5 py-2.5 rounded-2xl font-bold text-xs tracking-wide shadow-sm active:scale-95 transition-all duration-300">
                            🗑️ Delete Sparkle
                        </a>
                    </div>
                <?php endif; ?>
            </div>

        </div>

    </main>

    <div class="w-full z-50">
        <?php include '../cotton/snippets/footerkiss.php'; ?>
    </div>

</body>