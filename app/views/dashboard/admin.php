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
                        <a class="nav-link text-white" href="/srx/users">
                            <i class="bi bi-people"></i> Utilisateurs
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
                            <i class="bi bi-file-text"></i> Candidatures
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/srx/settings">
                            <i class="bi bi-gear"></i> Paramètres
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Tableau de bord administrateur</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-primary">Exporter</button>
                        <button type="button" class="btn btn-sm btn-outline-primary">Imprimer</button>
                    </div>
                </div>
            </div>

            <!-- Statistiques générales -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Étudiants</h5>
                            <p class="card-text display-6">150</p>
                            <small>+5 cette semaine</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Entreprises</h5>
                            <p class="card-text display-6">45</p>
                            <small>+2 cette semaine</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">Offres de stage</h5>
                            <p class="card-text display-6">67</p>
                            <small>+8 cette semaine</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title">Candidatures</h5>
                            <p class="card-text display-6">89</p>
                            <small>+12 cette semaine</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphiques -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Répartition des stages par compétence</h5>
                            <canvas id="skillsChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Évolution des candidatures</h5>
                            <canvas id="applicationsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dernières activités -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Activités récentes</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Utilisateur</th>
                                    <th>Action</th>
                                    <th>Détails</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>23/02/2025 15:30</td>
                                    <td>Jean Dupont</td>
                                    <td>Nouvelle candidature</td>
                                    <td>Stage développeur web chez ABC Corp</td>
                                </tr>
                                <tr>
                                    <td>23/02/2025 14:45</td>
                                    <td>Marie Martin</td>
                                    <td>Nouvelle entreprise</td>
                                    <td>XYZ Technologies ajoutée</td>
                                </tr>
                                <tr>
                                    <td>23/02/2025 14:15</td>
                                    <td>Paul Bernard</td>
                                    <td>Nouvelle offre</td>
                                    <td>Stage Data Analyst publié</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Graphique des compétences
const skillsCtx = document.getElementById('skillsChart').getContext('2d');
new Chart(skillsCtx, {
    type: 'pie',
    data: {
        labels: ['Développement Web', 'Data Science', 'DevOps', 'Design', 'Marketing'],
        datasets: [{
            data: [30, 20, 15, 10, 25],
            backgroundColor: [
                '#007bff',
                '#28a745',
                '#17a2b8',
                '#ffc107',
                '#dc3545'
            ]
        }]
    }
});

// Graphique des candidatures
const applicationsCtx = document.getElementById('applicationsChart').getContext('2d');
new Chart(applicationsCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
        datasets: [{
            label: 'Candidatures',
            data: [15, 25, 35, 45, 65, 89],
            borderColor: '#007bff',
            tension: 0.1
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
</script>