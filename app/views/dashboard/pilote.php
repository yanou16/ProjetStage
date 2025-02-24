<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="/srx/dashboard">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/srx/students">
                            <i class="bi bi-mortarboard"></i> Mes Étudiants
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/srx/companies">
                            <i class="bi bi-building"></i> Entreprises
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/srx/internships">
                            <i class="bi bi-briefcase"></i> Offres de stage
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/srx/applications">
                            <i class="bi bi-file-text"></i> Suivi des candidatures
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Tableau de bord pilote</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button type="button" class="btn btn-sm btn-outline-primary me-2">
                        <i class="bi bi-file-earmark-excel"></i> Exporter les statistiques
                    </button>
                </div>
            </div>

            <!-- État des candidatures -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Étudiants sans stage</h5>
                            <p class="card-text display-6">15</p>
                            <small>sur 45 étudiants</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Stages trouvés</h5>
                            <p class="card-text display-6">30</p>
                            <small>67% des étudiants</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">Candidatures en cours</h5>
                            <p class="card-text display-6">25</p>
                            <small>cette semaine</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title">À relancer</h5>
                            <p class="card-text display-6">8</p>
                            <small>étudiants inactifs</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Liste des étudiants à suivre -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Étudiants nécessitant une attention particulière</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Étudiant</th>
                                    <th>Status</th>
                                    <th>Candidatures</th>
                                    <th>Dernière activité</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Jean Dupont</td>
                                    <td><span class="badge bg-danger">Sans stage</span></td>
                                    <td>0 candidatures</td>
                                    <td>Il y a 2 semaines</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">Contacter</button>
                                        <button class="btn btn-sm btn-outline-info">Voir profil</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Marie Martin</td>
                                    <td><span class="badge bg-warning">En recherche</span></td>
                                    <td>2 candidatures</td>
                                    <td>Il y a 5 jours</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">Contacter</button>
                                        <button class="btn btn-sm btn-outline-info">Voir profil</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Graphiques -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Progression des recherches</h5>
                            <canvas id="searchProgressChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Types de stages recherchés</h5>
                            <canvas id="internshipTypesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Graphique de progression des recherches
const progressCtx = document.getElementById('searchProgressChart').getContext('2d');
new Chart(progressCtx, {
    type: 'bar',
    data: {
        labels: ['Sans recherche', 'En recherche', 'En attente', 'Stage trouvé'],
        datasets: [{
            label: 'Nombre d\'étudiants',
            data: [5, 10, 15, 30],
            backgroundColor: [
                '#dc3545',
                '#ffc107',
                '#17a2b8',
                '#28a745'
            ]
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Graphique des types de stages
const typesCtx = document.getElementById('internshipTypesChart').getContext('2d');
new Chart(typesCtx, {
    type: 'doughnut',
    data: {
        labels: ['Développement', 'Data Science', 'Réseau', 'Cybersécurité', 'IA'],
        datasets: [{
            data: [12, 8, 5, 7, 3],
            backgroundColor: [
                '#007bff',
                '#28a745',
                '#ffc107',
                '#dc3545',
                '#17a2b8'
            ]
        }]
    }
});
</script>