<?php

$file = 'private/data.json';
$data = json_decode(file_get_contents($file), true);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if (isset($data['favicon'])): ?>
        <link rel="icon" href="<?= htmlspecialchars($data['favicon']) ?>">
    <?php endif; ?>
    <title>
        <?= htmlspecialchars($data['pageTitle']) ?>
    </title>
    <script>
        document.addEventListener('contextmenu', function (e) {
            console.log(e)
        });
    </script>
    <style>
        body {
            background-color:
                <?= htmlspecialchars($data['bgColor']) ?>
            ;
            <?php if (isset($data['bgImage'])): ?>
                background-image: url('<?= htmlspecialchars($data['bgImage']) ?>');
            <?php endif; ?>
        }
    </style>
    <link rel="stylesheet" href="public/style/style.css">
</head>

<body>
    <?php
    if ($data['bgImage'] != "" && isset($data['bgImage'])) {
        $blur = "0px";
        $gray = "0%";
        if ($data['bgBlur'] != "" && isset($data['bgBlur']))
            $blur = $data['bgBlur'];
        if ($data['bgGray'] != "" && isset($data['bgBlur']))
            $gray = $data['bgGray'];
        echo ("<img class='background' src='" . $data['bgImage'] . "' alt='Background' style='filter: blur(" . $blur . ") grayscale(". $gray .");'>");
    }

    if ($data['title'] != "" && isset($data['title'])) {
        echo ("<h1 class='title'>" . $data['title'] . "</h1>");
        if ($data['profile'] != "" && isset($data['profile'])) {
            echo ("<img class='pb title' src='" . $data['profile'] . "' alt='Profile Picture'>");
        }
    } else {
        if ($data['profile'] != "" && isset($data['profile'])) {
            echo ("<img class='pb no-title' src='" . $data['profile'] . "' alt='Profile Picture'>");
        }
    }
    ?>
    <h2>
        <?= htmlspecialchars($data['name']) ?>
    </h2>
    <h3>
        <?= htmlspecialchars($data['subtitle']) ?>
    </h3>

    <?php if (isset($data['links']) && is_array($data['links'])): ?>
        <?php foreach ($data['links'] as $link): ?>
            <a class="social" href="<?= htmlspecialchars($link['link']) ?>">
                <img src="<?= htmlspecialchars($link['image']) ?>" alt="<?= htmlspecialchars($link['linkName']) ?>">
                <p><?= htmlspecialchars($link['linkName']) ?></p>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
    <div class="footer">
        <p>By: <a href="https://filtastisch.eu/" style="text-decoration: underline;" target="_blank">filtastisch</a></p>
    </div>
</body>

</html>