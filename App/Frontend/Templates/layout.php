<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= isset($title) ? $title : 'My awesome website' ?></title>
    <link rel="stylesheet" href="/css/Envision.css" type="text/css">
</head>
<body>
    <div id="wrap">
        <header>
            <h1><a href="/">My awesome website</a></h1>
            <p>There is no way it's full of lorem ipsum...</p>
        </header>
        <nav>
            <ul>
                <li><a href="/">Homepage</a></li>
                <?php if ($user->isAuthenticated()) { ?>
                <li><a href="/admin/">Admin</a></li>
                <li><a href="/admin/news-insert.html">Post a news</a></li>
                <?php } ?>
            </ul>
        </nav>
        <div id="content-wrap">
            <section id="main">
                <?php if ($user->hasFlash()) echo '<p style="text-align: center;">' . $user->getFlash() . '</p>'; ?>
                <?= $content ?>
            </section>
        </div>
        <footer></footer>
    </div>
</body>
</html>