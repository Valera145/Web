<style>
  .error {
    border: 2px solid red;
  }
</style>
<body>
  <div class="table">
    <table>
      <tr>
        <th>Имя</th>
        <th>Почта</th>
        <th>Год</th>
        <th>Пол</th>
        <th>Кол-во конечностей</th>
        <th>Сверхсилы</th>
        <th>Био</th>
      </tr>
      <?php
      foreach($users as $user){
      ?>
            <tr>
              <td><?= $user['name']?></td>
              <td><?= $user['mail']?></td>
              <td><?= $user['year']?></td>
              <td><?= $user['sex']?></td>
              <td><?= $user['limb']?></td>
              <td><?php 
                $user_pwrs=array(
                    "immortal"=>FALSE,
                    "teleport"=>FALSE,
                    "telepat"=>FALSE
                );
                foreach($powers as $pwr){
                    if($pwr['id']==$user['id']){
                        if($pwr['power']=='Бессмертие'){
                            $user_pwrs['immortal']=TRUE;
                        }
                        if($pwr['power']=='Телепортация'){
                            $user_pwrs['teleport']=TRUE;
                        }
                        if($pwr['power']=='Телепатия'){
                            $user_pwrs['telepat']=TRUE;
                        }
                    }
                }
                if($user_pwrs['immortal']){echo 'Бессмертие<br>';}
                if($user_pwrs['teleport']){echo 'Телепортация<br>';}
                if($user_pwrs['telepat']){echo 'Телепатия<br>';}?>
              </td>
              <td><?= $user['bio']?></td>
              <td>
                <form method="get" action="edit.php">
                  <input name=edit_id value="<?= $user['id']?>" hidden>
                  <input type="submit" value=Edit>
                </form>
              </td>
            </tr>
      <?php
       }
      ?>
    </table>
    <?php
    printf('Кол-во пользователей с сверхспособностью "Бессмертие": %d <br>',$powers_count[0]);
    printf('Кол-во пользователей с сверхспособностью "Телепортация": %d <br>',$powers_count[1]);
    printf('Кол-во пользователей с сверхспособностью "Телепатия": %d <br>',$powers_count[2]);
    ?>
  </div>
</body>
