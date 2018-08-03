<form action="" method="post">
    <p>
        <?= isset($errors) && in_array(\Entity\Comment::INVALID_AUTHOR, $errors) ? 'The author is invalid.<br />' : '' ?>
        <label for="pseudo">Pseudo</label>
        <input id="pseudo" type="text" name="pseudo" value="<?= isset($comment) ? htmlspecialchars($comment['author']) : '' ?>" />
        <br />
        <?= isset($errors) && in_array(\Entity\Comment::INVALID_COMMENT, $errors) ? 'The comment is invalid.<br />' : '' ?>
        <label for="content">Content</label>
        <textarea id="content" name="content" cols="50" rows="7"><?= isset($comment) ? htmlspecialchars($comment['content']) : '' ?></textarea>
        <br />
        <input type="hidden" value="<?= $comment['id'] ?>" name="id">
        <input type="hidden" value="<?= $comment['news'] ?>" name="news" >
        <input type="submit" value="Edit">
    </p>
</form>