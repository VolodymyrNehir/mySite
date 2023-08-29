<?php
include_once 'Model/Model.php';
$get = $_POST['get'];
$users = Model::selectUsers();
$role = [1=>"Admin",2=>"User"];
?>
<?php foreach ($users as $user) : ?>
    <tr id="<?= $user['id'] ?>" status="<?= $user['status'] ?>">
        <th><input type="checkbox" class="check"></th>
        <td>
            <span scope="col" class="firstName"><?= $user['firstName'] ?></span>
            <span class="lastName"><?= $user['lastName'] ?></span>
        </td>
        <td class="role"><?= $role[$user['role']] ?></td>
        <td>
            <div class="status">
                <div class="colo"></div>
            </div>
        </td>
        <td>
            <div class="status">
                <div class="butt">
                    <button class="buttonEdit">
                        <i>Edit</i>
                    </button>
                    <button class="buttonDelete">
                        <i class="bi bi-trash3"></i>
                    </button>
                </div>
            </div>
        </td>
    </tr>
<?php endforeach; ?>
