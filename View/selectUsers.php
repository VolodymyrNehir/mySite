<?php
include_once 'Model/Model.php';
$get = $_POST['get'];
$pdo = new Model();
$users = $pdo->selectUsers();

?>
<?php foreach ($users as $user)
 {
     ?>

         <tr id="<?= $user['id']?>" status="<?= $user['status'] ?>">
             <th><input type="checkbox" class="check"></th>
             <td>
                 <span scope="col" class="firstName"><?= $user['firstName'] ?></span>
                 <span class="lastName"><?= $user['lastName'] ?></span>
             </td>
             <td class="role"><?= $user['role'] ?></td>
             <td>
                 <div class="status">
                     <div class="colo" >
                     </div>
                 </div>
             </td>
             <td>
                 <div class="status">
                     <div class="butt ">
                         <button class="btn1 btnEdit " ><img src="./icons/edit.svg" alt="edit" ></button>
                         <button class="btn2"><img src="./icons/svgviewer-trash.svg" alt="trash"></button>
                     </div>
                 </div>
             </td>
         </tr>

<?php } ?>

