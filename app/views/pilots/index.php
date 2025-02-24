<?php
// Extraction des variables
if (isset($data)) {
    extract($data);
}

// Valeurs par défaut
$pilots = $pilots ?? [];
?>
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= $title ?? 'Gestion des pilotes' ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="/srx/pilots/create" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-plus"></i> Nouveau pilote
            </a>
        </div>
    </div>

    <?php if (isset($_SESSION['flash_message'])): ?>
    <div class="alert alert-<?= $_SESSION['flash_message']['type'] ?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['flash_message']['message'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php 
        unset($_SESSION['flash_message']);
    endif; 
    ?>

    <!-- Recherche -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" id="searchPilot" class="form-control" placeholder="Rechercher un pilote...">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Liste des pilotes -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Date de création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pilots)): ?>
                            <?php foreach ($pilots as $pilot): ?>
                                <tr>
                                    <td><?= htmlspecialchars($pilot['lastname']) ?></td>
                                    <td><?= htmlspecialchars($pilot['firstname']) ?></td>
                                    <td><?= htmlspecialchars($pilot['email']) ?></td>
                                    <td><?= htmlspecialchars($pilot['created_at']) ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="/srx/pilots/edit/<?= $pilot['id'] ?>" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete(<?= $pilot['id'] ?>)">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Aucun pilote trouvé</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce pilote ?')) {
        window.location.href = `/srx/pilots/delete/${id}`;
    }
}

document.getElementById('searchPilot').addEventListener('input', function(e) {
    const searchValue = e.target.value;
    if (searchValue.length >= 2) {
        fetch(`/srx/pilots/search?q=${encodeURIComponent(searchValue)}`)
            .then(response => response.json())
            .then(pilots => {
                updatePilotsDisplay(pilots);
            })
            .catch(error => console.error('Erreur:', error));
    }
});

function updatePilotsDisplay(pilots) {
    const tbody = document.querySelector('tbody');
    if (!pilots || pilots.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="5" class="text-center">Aucun pilote trouvé</td>
            </tr>
        `;
        return;
    }

    tbody.innerHTML = pilots.map(pilot => `
        <tr>
            <td>${escapeHtml(pilot.lastname)}</td>
            <td>${escapeHtml(pilot.firstname)}</td>
            <td>${escapeHtml(pilot.email)}</td>
            <td>${escapeHtml(pilot.created_at)}</td>
            <td>
                <div class="btn-group">
                    <a href="/srx/pilots/edit/${pilot.id}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete(${pilot.id})">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
    `).join('');
}

function escapeHtml(unsafe) {
    return unsafe
        ? unsafe
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;")
        : '';
}
</script>