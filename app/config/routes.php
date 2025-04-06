// Routes pour les utilisateurs
'users' => ['controller' => 'Users', 'action' => 'index'],
'users/create' => ['controller' => 'Users', 'action' => 'create'],
'users/edit/{id}' => ['controller' => 'Users', 'action' => 'edit'],
'users/delete/{id}' => ['controller' => 'Users', 'action' => 'delete'],
'users/login' => ['controller' => 'Users', 'action' => 'login'],
'users/logout' => ['controller' => 'Users', 'action' => 'logout'],

// Route pour les étudiants du pilote
'pilotstudents' => ['controller' => 'Pilotstudents', 'action' => 'index'],

// Routes pour les entreprises 