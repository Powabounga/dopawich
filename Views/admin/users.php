<table class="table table-striped">
    <thead>
        <th>ID</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Adresse mail</th>
    </thead>
    <tbody>
        <?php foreach($users as $user):  ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= $user->last_name ?></td>
            <td><?= $user->first_name ?></td>
            <td><?= $user->email ?></td>
            <td>
                <a href="/admin/supprimeUser/<?= $user->id ?>" class="btn btn-danger">Supprimer</a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>