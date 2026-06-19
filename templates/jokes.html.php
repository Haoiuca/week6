<?php foreach($jokes as $joke): ?>
    <blockquote>
        <?=htmlspecialchars($joke['joketext'], ENT_QUOTES, 'UTF-8')?>
        (by <a href="mailto:<?=htmlspecialchars($joke['email'], ENT_QUOTES, 'UTF-8')?>">
            <?=htmlspecialchars($joke['name'], ENT_QUOTES, 'UTF-8')?>
        </a>)

        <br>
            <?php $imageFile = !empty($joke['jokeimg']) ? $joke['jokeimg'] : 'default.png'; ?>
            <img src="uploads/<?= htmlspecialchars($imageFile, ENT_QUOTES, 'UTF-8') ?>" 
                 alt="Joke Image" 
                 style="max-width: 150px; height: auto; display: block; margin-top: 10px;">

        <small>(Added on: <?= htmlspecialchars($joke['jokedate'] ?? 'Unknown', ENT_QUOTES, 'UTF-8') ?>)</small>

        <a href="editjoke.php?id=<?= $joke['id'] ?>">Edit</a>

        <form action="deletejoke.php" method="post">
            <input type="hidden" name="id" value="<?= $joke['id'] ?>">
            <input type="submit" value="Delete">
        </form>
    </blockquote>
    <?php endforeach; ?>