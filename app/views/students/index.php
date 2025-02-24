<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Gestion des étudiants</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="/srx/students/stats" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-graph-up"></i> Statistiques
                </a>
            </div>
            <a href="/srx/students/create" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-plus"></i> Nouvel étudiant
            </a>
        </div>
    </div>

    <!-- Filtres et recherche -->
    <div class="row mb-4">
        <div class="col-md-4">
            <select id="promotionFilter" class="form-select">
                <option value="">Toutes les promotions</option>
                <?php foreach ($promotions as $promotion): ?>
                    <option value="<?= $promotion['id'] ?>"><?= htmlspecialchars($promotion['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" id="searchStudent" class="form-control" placeholder="Rechercher un étudiant...">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Liste des étudiants -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Promotion</th>
                            <th>Statut stage</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?= htmlspecialchars($student['lastname']) ?></td>
                                <td><?= htmlspecialchars($student['firstname']) ?></td>
                                <td><?= htmlspecialchars($student['email']) ?></td>
                                <td><?= htmlspecialchars($student['promotion_name']) ?></td>
                                <td>
                                    <?php
                                    $statusClass = 'bg-warning';
                                    $statusText = 'En recherche';
                                    if ($student['internship_status'] === 'accepted') {
                                        $statusClass = 'bg-success';
                                        $statusText = 'Stage trouvé';
                                    }
                                    ?>
                                    <span class="badge <?= $statusClass ?>"><?= $statusText ?></span>
                                </td>
                                <td>
                                    <a href="/srx/students/view/<?= $student['id'] ?>" class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="/srx/students/edit/<?= $student['id'] ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <?php if ($_SESSION['user']['role_name'] === 'admin'): ?>
                                        <button onclick="deleteStudent(<?= $student['id'] ?>)" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('promotionFilter').addEventListener('change', function(e) {
    const promotionId = e.target.value;
    window.location.href = `/srx/students${promotionId ? '?promotion_id=' + promotionId : ''}`;
});

document.getElementById('searchStudent').addEventListener('input', function(e) {
    const query = e.target.value;
    const promotionId = document.getElementById('promotionFilter').value;
    
    if (query.length >= 2) {
        fetch(`/srx/students/search?q=${encodeURIComponent(query)}&promotion_id=${promotionId}`)
            .then(response => response.json())
            .then(students => {
                updateStudentsTable(students);
            });
    }
});

function deleteStudent(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')) {
        window.location.href = `/srx/students/delete/${id}`;
    }
}

function updateStudentsTable(students) {
    // Mise à jour du tableau des étudiants
    const tbody = document.querySelector('tbody');
    tbody.innerHTML = students.map(student => `
        <tr>
            <td>${escapeHtml(student.lastname)}</td>
            <td>${escapeHtml(student.firstname)}</td>
            <td>${escapeHtml(student.email)}</td>
            <td>${escapeHtml(student.promotion_name)}</td>
            <td>
                <span class="badge ${student.internship_status === 'accepted' ? 'bg-success' : 'bg-warning'}">
                    ${student.internship_status === 'accepted' ? 'Stage trouvé' : 'En recherche'}
                </span>
            </td>
            <td>
                <a href="/srx/students/view/${student.id}" class="btn btn-sm btn-outline-info">
                    <i class="bi bi-eye"></i>
                </a>
                <a href="/srx/students/edit/${student.id}" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-pencil"></i>
                </a>
                ${isAdmin ? `
                    <button onclick="deleteStudent(${student.id})" class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-trash"></i>
                    </button>
                ` : ''}
            </td>
        </tr>
    `).join('');
}

function escapeHtml(unsafe) {
    return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

const isAdmin = <?= json_encode($_SESSION['user']['role_name'] === 'admin') ?>;
</script>