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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['babe_id'])) {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $user_id = $_SESSION['babe_id'];
        
        if ($action === 'comment') {
            $isi = trim($_POST['isi']);
            $parent_id = isset($_POST['parent_id']) && $_POST['parent_id'] !== '' ? (int)$_POST['parent_id'] : null;
            if ($isi !== '') {
                $stmt = mysqli_prepare($heart, "INSERT INTO comments (sparkle_id, babe_id, parent_id, isi) VALUES (?, ?, ?, ?)");
                mysqli_stmt_bind_param($stmt, "iiis", $id, $user_id, $parent_id, $isi);
                mysqli_stmt_execute($stmt);
            }
        } elseif ($action === 'like') {
            $comment_id = (int)$_POST['comment_id'];
            $stmt = mysqli_prepare($heart, "SELECT id FROM comment_likes WHERE comment_id = ? AND babe_id = ?");
            mysqli_stmt_bind_param($stmt, "ii", $comment_id, $user_id);
            mysqli_stmt_execute($stmt);
            $like_res = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($like_res) > 0) {
                $stmt = mysqli_prepare($heart, "DELETE FROM comment_likes WHERE comment_id = ? AND babe_id = ?");
                mysqli_stmt_bind_param($stmt, "ii", $comment_id, $user_id);
                mysqli_stmt_execute($stmt);
            } else {
                $stmt = mysqli_prepare($heart, "INSERT INTO comment_likes (comment_id, babe_id) VALUES (?, ?)");
                mysqli_stmt_bind_param($stmt, "ii", $comment_id, $user_id);
                mysqli_stmt_execute($stmt);
            }
        } elseif ($action === 'pin' && $_SESSION['babe_id'] == $video['babe_id']) {
            $comment_id = (int)$_POST['comment_id'];
            $stmt = mysqli_prepare($heart, "SELECT is_pinned FROM comments WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "i", $comment_id);
            mysqli_stmt_execute($stmt);
            $c_data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
            
            $stmt = mysqli_prepare($heart, "UPDATE comments SET is_pinned = 0 WHERE sparkle_id = ?");
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            
            if ($c_data && !$c_data['is_pinned']) {
                $stmt = mysqli_prepare($heart, "UPDATE comments SET is_pinned = 1 WHERE id = ?");
                mysqli_stmt_bind_param($stmt, "i", $comment_id);
                mysqli_stmt_execute($stmt);
            }
        }
        header("Location: watching.php?id=" . $id);
        exit;
    }
}

preg_match(
    '/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/',
    $video['youtube_url'],
    $matches
);

$video_id = $matches[1] ?? '';

$stmt = mysqli_prepare(
    $heart,
    "SELECT comments.*, babes.nama, 
     (SELECT COUNT(*) FROM comment_likes WHERE comment_id = comments.id) as likes_count,
     EXISTS(SELECT 1 FROM comment_likes WHERE comment_id = comments.id AND babe_id = ?) as is_liked
     FROM comments
     JOIN babes ON comments.babe_id = babes.id
     WHERE comments.sparkle_id = ?
     ORDER BY comments.is_pinned DESC, comments.created_at DESC"
);
$current_user_id = $_SESSION['babe_id'] ?? 0;
mysqli_stmt_bind_param($stmt, "ii", $current_user_id, $id);
mysqli_stmt_execute($stmt);
$comments_res = mysqli_stmt_get_result($stmt);

$all_comments = [];
while ($row = mysqli_fetch_assoc($comments_res)) {
    $all_comments[] = $row;
}

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

        <div class="mt-8 bg-white/80 dark:bg-zinc-800/60 rounded-3xl shadow-xl border border-zinc-100 dark:border-zinc-700/30 p-6 md:p-8 backdrop-blur-xl">
            <h3 class="text-xl font-black mb-6 text-zinc-800 dark:text-zinc-100 tracking-tight flex items-center gap-2">
                💬 Comments
            </h3>

            <?php if (isset($_SESSION['babe_id'])): ?>
                <form method="POST" action="" class="mb-8 flex flex-col gap-3">
                    <input type="hidden" name="action" value="comment">
                    <textarea 
                        name="isi" 
                        rows="3" 
                        placeholder="Add a public comment..." 
                        required 
                        class="w-full p-4 rounded-2xl border border-zinc-200 dark:border-zinc-700 bg-transparent focus:outline-none focus:ring-2 focus:ring-pink-500 text-sm font-medium resize-none"></textarea>
                    <button 
                        type="submit" 
                        class="self-end bg-pink-500 hover:bg-pink-600 text-white px-5 py-2 rounded-2xl font-bold text-xs tracking-wide active:scale-95 transition-all duration-300 shadow-md">
                        Comment
                    </button>
                </form>
            <?php else: ?>
                <p class="text-sm font-medium text-zinc-400 mb-8">Please login to join the conversation.</p>
            <?php endif; ?>

            <div class="space-y-6">
                <?php 
                foreach ($all_comments as $comment) {
                    if ($comment['parent_id'] === null) {
                        ?>
                        <div class="bg-zinc-50/50 dark:bg-zinc-900/30 p-5 rounded-2xl border border-zinc-100 dark:border-zinc-800/50 space-y-4">
                            <?php if ($comment['is_pinned']): ?>
                                <div class="flex items-center gap-1 text-xs font-bold text-pink-500">
                                    📌 Pinned by creator
                                </div>
                            <?php endif; ?>
                            
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-xl bg-pink-500 flex items-center justify-center text-xs font-black text-white uppercase shrink-0">
                                    <?= mb_substr(htmlspecialchars($comment['nama']), 0, 1) ?>
                                </div>
                                <div class="space-y-1 flex-1">
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-bold text-zinc-700 dark:text-zinc-200"><?= htmlspecialchars($comment['nama']) ?></span>
                                        <?php if ($comment['babe_id'] == $video['babe_id']): ?>
                                            <span class="bg-pink-500 text-white text-[9px] font-black px-1.5 py-0.5 rounded-md uppercase">Creator</span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-sm font-medium text-zinc-600 dark:text-zinc-300"><?= nl2br(htmlspecialchars($comment['isi'])) ?></p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4 pl-11 text-xs">
                                <form method="POST" action="" class="inline">
                                    <input type="hidden" name="action" value="like">
                                    <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                    <button type="submit" class="font-bold flex items-center gap-1 <?= $comment['is_liked'] ? 'text-pink-500' : 'text-zinc-400 hover:text-zinc-600' ?>">
                                        👍 <span><?= $comment['likes_count'] ?></span>
                                    </button>
                                </form>

                                <?php if (isset($_SESSION['babe_id'])): ?>
                                    <button onclick="document.getElementById('reply-form-<?= $comment['id'] ?>').classList.toggle('hidden')" class="font-bold text-zinc-400 hover:text-zinc-600">
                                        Reply
                                    </button>
                                <?php endif; ?>

                                <?php if (isset($_SESSION['babe_id']) && $_SESSION['babe_id'] == $video['babe_id']): ?>
                                    <form method="POST" action="" class="inline">
                                        <input type="hidden" name="action" value="pin">
                                        <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                        <button type="submit" class="font-bold text-zinc-400 hover:text-pink-500">
                                            <?= $comment['is_pinned'] ? 'Unpin' : 'Pin' ?>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>

                            <form id="reply-form-<?= $comment['id'] ?>" method="POST" action="" class="hidden pl-11 flex flex-col gap-2">
                                <input type="hidden" name="action" value="comment">
                                <input type="hidden" name="parent_id" value="<?= $comment['id'] ?>">
                                <textarea name="isi" rows="2" placeholder="Reply to this comment..." required class="w-full p-3 rounded-xl border border-zinc-200 dark:border-zinc-700 bg-transparent focus:outline-none focus:ring-1 focus:ring-pink-500 text-xs font-medium resize-none"></textarea>
                                <button type="submit" class="self-end bg-zinc-800 dark:bg-zinc-100 text-white dark:text-zinc-800 px-4 py-1.5 rounded-xl font-bold text-[11px] tracking-wide active:scale-95 transition-all duration-300 shadow-sm">
                                    Reply
                                </button>
                            </form>

                            <?php 
                            foreach ($all_comments as $reply) {
                                if ($reply['parent_id'] == $comment['id']) {
                                    ?>
                                    <div class="pl-11 pt-2 flex items-start gap-3 border-l-2 border-zinc-100 dark:border-zinc-800">
                                        <div class="w-6 h-6 rounded-lg bg-rose-400 flex items-center justify-center text-[10px] font-black text-white uppercase shrink-0">
                                            <?= mb_substr(htmlspecialchars($reply['nama']), 0, 1) ?>
                                        </div>
                                        <div class="space-y-0.5 flex-1">
                                            <div class="flex items-center gap-2">
                                                <span class="text-xs font-bold text-zinc-700 dark:text-zinc-200"><?= htmlspecialchars($reply['nama']) ?></span>
                                                <?php if ($reply['babe_id'] == $video['babe_id']): ?>
                                                    <span class="bg-pink-500 text-white text-[8px] font-black px-1 py-0.5 rounded-md uppercase">Creator</span>
                                                <?php endif; ?>
                                            </div>
                                            <p class="text-xs font-medium text-zinc-600 dark:text-zinc-300"><?= nl2br(htmlspecialchars($reply['isi'])) ?></p>
                                            
                                            <div class="flex items-center gap-3 pt-1 text-[11px]">
                                                <form method="POST" action="" class="inline">
                                                    <input type="hidden" name="action" value="like">
                                                    <input type="hidden" name="comment_id" value="<?= $reply['id'] ?>">
                                                    <button type="submit" class="font-bold flex items-center gap-1 <?= $reply['is_liked'] ? 'text-pink-500' : 'text-zinc-400 hover:text-zinc-600' ?>">
                                                        👍 <span><?= $reply['likes_count'] ?></span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>

    </main>

    <div class="w-full z-50">
        <?php include '../cotton/snippets/footerkiss.php'; ?>
    </div>

</body>