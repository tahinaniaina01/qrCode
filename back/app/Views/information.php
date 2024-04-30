<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats</title>
</head>
<body>
    <h1>Résultats</h1>
    <?php if (!empty($result)): ?>
        <p>Nom: <?= $result['nom'] ?></p>
        <p>Prénom: <?= $result['prenom'] ?></p>
        <p>Grade: <?= $result['grade'] ?></p>
        <p>Statut: <?= $result['statut'] ?></p>
        <p>ID: <?= $result['id'] ?></p>
    <?php elseif (!empty($error)): ?>
        <p>Erreur: <?= $error ?></p>
    <?php else: ?>
        <p>Aucun résultat trouvé</p>
    <?php endif; ?>
</body>
</html>
