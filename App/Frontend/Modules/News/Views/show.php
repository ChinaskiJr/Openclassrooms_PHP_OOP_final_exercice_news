<h2><?= $news['title'] ?></h2>
<p>A post by <?= $news['author'] ?> written the <?= $news['dateAdd']->format('d/m/Y \a\t H\hi') ?></p>
<br />
<p><?= nl2br($news['content']) ?></p>
<?php if ($news['dateEdit'] != $news['dateAdd']) { ?>
    <br />
    <p>Updated the <?= $news['dateEdit']->format('d/m/Y \a\t H\hi') ?></p>
<?php } ?>

<p><a href="comment-<?= $news['id'] ?>.html">Post a comment</a></p>

<?php
if (empty($comments)) {
    ?>
    <p>No one has commented this yet. Wanna be the first ?</p>
    <?php
} else {
    foreach ($comments as $comment) {
        ?>
        <fieldset>
            <legend>
                Posted by <strong><?= htmlspecialchars($comment['author']) ?></strong>
                the <?= $comment['date']->format('d/mY \a\t H\hi') ?>
                <?php
                    if ($user->isAuthenticated()) {
                        ?>
                        <a href="admin/comment-update-<?= $comment['id'] ?>.html">Edit</a>
                        <a href="admin/comment-delete-<?= $comment['id'] ?>.html">Delete</a>
                        <?php
                    }
                ?>
            </legend>
            <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
        </fieldset>
        <br />
        <?php
    }
}
?>