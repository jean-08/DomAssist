<?php require __DIR__ . '/../layout/header.php'; ?>
<h2>Utilisateurs</h2>
<table>
  <tr><th>Nom</th><th>Prénom</th><th>Email</th><th>Rôle</th><th>Actions</th></tr>
  <?php foreach ($users as $u): ?>
  <tr>
    <td><?= htmlspecialchars($u['nom']) ?></td>
    <td><?= htmlspecialchars($u['prenom']) ?></td>
    <td><?= htmlspecialchars($u['email']) ?></td>
    <td><?= htmlspecialchars($u['role']) ?></td>
    <td>
      <a href="index.php?action=user_edit&id=<?= $u['id_user'] ?>">Modifier</a>
      <a href="index.php?action=user_delete&id=<?= $u['id_user'] ?>"
         onclick="return confirm('Supprimer ?')">Supprimer</a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>
<?php require __DIR__ . '/../layout/footer.php'; ?>