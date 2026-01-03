<!doctype html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h1>Kullanıcı Listesi</h1>
    <ul>
        <?php foreach($data['users'] as $user): ?>
            <li><?php echo $user['name'] . " - " . $user['email']; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
