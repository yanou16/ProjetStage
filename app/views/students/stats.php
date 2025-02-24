<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Statistiques des étudiants</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.print()">
                <i class="bi bi-printer"></i> Imprimer
            </button>
        </div>
    </div>

    <!-- Statistiques générales -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total étudiants</h5>
                    <p class="card-text display-6"><?= $stats['total'] ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Stages trouvés</h5>
                    <p class="card-text display-6"><?= $stats['internships']['with_internship'] ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">En recherche</h5>
                    <p class="card-text display-6"><?= $stats['internships']['searching'] ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Taux de placement</h5>
                    <?php
                    $placementRate = $stats['total'] > 0 
                        ? round(($stats['internships']['with_internship'] / $stats['total']) * 100) 
                        : 0;
                    ?>
                    <p class="card-text display-6"><?= $placementRate ?>%</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Répartition par promotion</h5>
                    <canvas id="promotionChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">État des recherches de stage</h5>
                    <canvas id="internshipChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Graphique des promotions
const promotionCtx = document.getElementById('promotionChart').getContext('2d');
new Chart(promotionCtx, {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_column($stats['by_promotion'], 'name')) ?>,
        datasets: [{
            label: 'Nombre d\'étudiants',
            data: <?= json_encode(array_column($stats['by_promotion'], 'count')) ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
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

// Graphique des stages
const internshipCtx = document.getElementById('internshipChart').getContext('2d');
new Chart(internshipCtx, {
    type: 'pie',
    data: {
        labels: ['Stage trouvé', 'En recherche', 'Sans recherche'],
        datasets: [{
            data: [
                <?= $stats['internships']['with_internship'] ?>,
                <?= $stats['internships']['searching'] ?>,
                <?= $stats['total'] - $stats['internships']['with_internship'] - $stats['internships']['searching'] ?>
            ],
            backgroundColor: [
                'rgba(40, 167, 69, 0.2)',
                'rgba(255, 193, 7, 0.2)',
                'rgba(220, 53, 69, 0.2)'
            ],
            borderColor: [
                'rgba(40, 167, 69, 1)',
                'rgba(255, 193, 7, 1)',
                'rgba(220, 53, 69, 1)'
            ],
            borderWidth: 1
        }]
    }
});
</script>