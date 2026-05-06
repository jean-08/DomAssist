<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DomAssist</title>
<link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<nav>
  <a href="index.php?action=dashboard"><strong>DomAssist</strong></a>
  <?php if (isset($_SESSION['user'])): ?>
    <a href="index.php?action=demandes">Demandes</a>
    <a href="index.php?action=prestataires">Prestataires</a>
    <a href="index.php?action=services">Services</a>
    <a href="index.php?action=interventions">Interventions</a>
    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
      <a href="index.php?action=users">Utilisateurs</a>
      <a href="index.php?action=produits">Produits</a>
    <?php endif; ?>
    <?php if ($_SESSION['user']['role'] === 'prestataire'): ?>
      <a href="index.php?action=disponibilites">Disponibilités</a>
    <?php endif; ?>
    <a href="index.php?action=profile">Profil</a>
    <a href="index.php?action=logout">Déconnexion</a>
  <?php endif; ?>
</nav>
<div class="container">
<?php if (!empty($_SESSION['error'])): ?>
  <div class="alert error"><?= htmlspecialchars($_SESSION['error']) ?></div>
  <?php unset($_SESSION['error']); ?>
<?php endif; ?>
<?php if (!empty($_SESSION['success'])): ?>
  <div class="alert success"><?= htmlspecialchars($_SESSION['success']) ?></div>
  <?php unset($_SESSION['success']); ?>
<?php endif; ?>