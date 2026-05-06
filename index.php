<?php
session_start();
require_once __DIR__ . '/config/database.php';

$action = $_GET['action'] ?? 'dashboard';

$public = ['login', 'register'];
if (!isset($_SESSION['user']) && !in_array($action, $public)) {
    header('Location: index.php?action=login'); exit;
}

$routes = [
    'login'                  => ['AuthController',         'login'],
    'register'               => ['AuthController',         'register'],
    'logout'                 => ['AuthController',         'logout'],
    'users'                  => ['UserController',         'index'],
    'user_edit'              => ['UserController',         'edit'],
    'user_delete'            => ['UserController',         'delete'],
    'profile'                => ['UserController',         'profile'],
    'prestataires'           => ['PrestataireController',  'index'],
    'prestataire_show'       => ['PrestataireController',  'show'],
    'prestataire_create'     => ['PrestataireController',  'create'],
    'prestataire_edit'       => ['PrestataireController',  'edit'],
    'prestataire_delete'     => ['PrestataireController',  'delete'],
    'prestataire_competence' => ['PrestataireController',  'addCompetence'],
    'demandes'               => ['DemandeController',      'index'],
    'demande_create'         => ['DemandeController',      'create'],
    'demande_show'           => ['DemandeController',      'show'],
    'demande_statut'         => ['DemandeController',      'updateStatut'],
    'demande_delete'         => ['DemandeController',      'delete'],
    'diagnostic_create'      => ['DiagnosticController',   'create'],
    'diagnostic_show'        => ['DiagnosticController',   'show'],
    'interventions'          => ['InterventionController', 'index'],
    'intervention_create'    => ['InterventionController', 'create'],
    'disponibilites'         => ['DisponibiliteController','index'],
    'disponibilite_create'   => ['DisponibiliteController','create'],
    'disponibilite_delete'   => ['DisponibiliteController','delete'],
    'services'               => ['ServiceController',      'index'],
    'service_create'         => ['ServiceController',      'create'],
    'service_delete'         => ['ServiceController',      'delete'],
    'solution_create'        => ['SolutionController',     'create'],
    'produits'               => ['ProduitController',      'index'],
    'produit_create'         => ['ProduitController',      'create'],
    'produit_delete'         => ['ProduitController',      'delete'],
    'avis_create'            => ['AvisController',         'create'],
    'avis_delete'            => ['AvisController',         'delete'],
];

if ($action === 'dashboard') {
    require __DIR__ . '/views/layout/header.php';
    $role = $_SESSION['user']['role'] ?? '';
    echo '<h2>Bienvenue, ' . htmlspecialchars($_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']) . '</h2>';
    echo '<p>Rôle : <strong>' . htmlspecialchars($role) . '</strong></p><ul>';
    echo '<li><a href="index.php?action=demandes">Mes demandes</a></li>';
    echo '<li><a href="index.php?action=prestataires">Prestataires</a></li>';
    echo '<li><a href="index.php?action=services">Services</a></li>';
    echo '<li><a href="index.php?action=interventions">Interventions</a></li>';
    if ($role === 'admin')       { echo '<li><a href="index.php?action=users">Utilisateurs</a></li><li><a href="index.php?action=produits">Produits</a></li>'; }
    if ($role === 'prestataire') { echo '<li><a href="index.php?action=disponibilites">Mes disponibilités</a></li>'; }
    echo '</ul>';
    require __DIR__ . '/views/layout/footer.php';
    exit;
}

if (!isset($routes[$action])) {
    http_response_code(404);
    require __DIR__ . '/views/layout/header.php';
    echo '<h2>Page introuvable</h2><a href="index.php?action=dashboard">← Retour</a>';
    require __DIR__ . '/views/layout/footer.php';
    exit;
}

[$class, $method] = $routes[$action];
require_once __DIR__ . '/controllers/' . $class . '.php';
$controller = new $class();
$controller->$method();
