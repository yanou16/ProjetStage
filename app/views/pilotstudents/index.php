<?php
// Extraction des variables
if (isset($data)) {
    extract($data);
}
?>
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= $title ?? 'Gestion des étudiants' ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="/srx/pilot_students/create" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-lg"></i> Ajouter un étudiant
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

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Promotion</th>
                    <th>Date de création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($students)): ?>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?= htmlspecialchars($student['lastname']) ?></td>
                            <td><?= htmlspecialchars($student['firstname']) ?></td>
                            <td><?= htmlspecialchars($student['email']) ?></td>
                            <td><?= htmlspecialchars($student['promotion_name'] ?? 'Non assignée') ?></td>
                            <td><?= (new DateTime($student['created_at']))->format('d/m/Y') ?></td>
                            <td>
                                <a href="/srx/pilot_students/edit/<?= $student['id'] ?>" class="btn btn-sm btn-outline-primary me-2">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                        onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')) 
                                                 window.location.href='/srx/pilot_students/delete/<?= $student['id'] ?>'">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Aucun étudiant trouvé</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>