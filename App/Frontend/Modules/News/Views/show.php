<h2><?= $news['title'] ?></h2>
<p>A post by <?= $news['author'] ?> written the <?= $news['dateAdd']->format('d/m/Y \a\t H\hi') ?></p>
<br />
<p><?= nl2br($news['content']) ?></p>
<?php if ($news['dateEdit'] != $news['dateAdd']) { ?>
    <br />
    <p>Updated the <?= $news['dateEdit']->format('d/m/Y \a\t H\hi') ?></p>
<?php } ?>