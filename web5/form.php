<style>
  #content, header div{
    background-color: rgba(123, 0, 212, 0.1);
    max-width: 960px;
    margin: 0 auto;
}
body{
    font-family: "Montserrat", sans-serif;
}
div.table ,#form, div.link-list{
    background-color: rgba(123, 0, 212, 0.24);
}
label {
    margin:10px 0;
}
input[type=text] {
  padding:10px;
  margin:10px 0;
  border:1;
    border-radius:15px;
  box-shadow:0 0 15px 4px rgba(0,0,0,0.06);
}
input[type=email] {
  padding:10px;
  margin:10px 0;
  border:1;
    border-radius:15px;
  box-shadow:0 0 15px 4px rgba(0,0,0,0.06);
}
select {
  padding:10px;
  border-radius:10px;
}
textarea {
  resize: vertical;
  padding:15px;
  margin:10px 0;
  border-radius:15px;
  border:1;
  box-shadow:4px 4px 10px rgba(0,0,0,0.06);
  height:150px;
}
.error {
    border: 3px solid red;
  }
</style>
<body>
<?php
if (!empty($messages)) {
  print('<div id="messages">');
  // Выводим все сообщения.
  foreach ($messages as $message) {
    print($message);
  }
  print('</div>');
}
?>
  <div class="form1">
  <form action="index.php" method="POST">
    <label> ФИО </label> <br>
    <input name="name" <?php if ($errors['name']) {print 'class="error"';} ?> value="<?php print $values['name']; ?>" /> <br>
    <label> Почта </label> <br>
    <input name="email" type="email" <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>"/> <br>
    <label> Год рождения </label> <br>
    <select name="year" <?php if ($errors['year']) {print 'class="error"';} ?>>
      <option value="Выбрать">Выбрать</option>
    <?php
        for($i=1800;$i<=2022;$i++){
          if($values['year']==$i){
            printf("<option value=%d selected>%d год</option>",$i,$i);
          }
          else{
            printf("<option value=%d>%d год</option>",$i,$i);
          }
        }
    ?>
    </select> <br>
    <label> Ваш пол </label> <br>
    <div <?php if ($errors['sex']) {print 'class="error"';} ?>>
      <input name="sex" type="radio" value="M" <?php if($values['sex']=="M") {print 'checked';} ?>/> Мужчина
      <input name="sex" type="radio" value="W" <?php if($values['sex']=="W") {print 'checked';} ?>/> Женщина
    </div>
    <label> Сколько у вас конечностей </label> <br>
    <div <?php if ($errors['limb']) {print 'class="error"';} ?>>
      <input name="limb" type="radio" value="1" <?php if($values['limb']=="1") {print 'checked';} ?>/> 1 
      <input name="limb" type="radio" value="2" <?php if($values['limb']=="2") {print 'checked';} ?>/> 2 
      <input name="limb" type="radio" value="3" <?php if($values['limb']=="3") {print 'checked';} ?>/> 3 
      <input name="limb" type="radio" value="4" <?php if($values['limb']=="4") {print 'checked';} ?>/> 4 
    </div>
    <label> Выберите суперспособности </label> <br>
    <select name="power[]" size="3" multiple <?php if ($errors['powers']) {print 'class="error"';} ?>>
      <option value="Телепортация" <?php if($values['teleport']==1){print 'selected';} ?>>Телепортация</option>
      <option value="Бессмертие" <?php if($values['immortal']==1){print 'selected';} ?>>Бессмертие</option>
      <option value="Телепатия" <?php if($values['telepat']==1){print 'selected';} ?>>Телепатия</option>
    </select> <br>
    <label> Краткая биография </label> <br>
    <textarea name="bio" rows="10" cols="15"><?php print $values['bio']; ?></textarea> <br>
    <?php 
    $cl_e='';
    $ch='';
    if($values['check'] or !empty($_SESSION['login'])){
      $ch='checked';
    }
    if ($errors['check']) {
      $cl_e='class="error"';
    }
    if(empty($_SESSION['login'])){
    print('
    <div  '.$cl_e.' >
    <input name="check" type="checkbox" '.$ch.'> Вы согласны с пользовательским соглашением <br>
    </div>');}
    ?>
    <input type="submit" value="Отправить"/>
  </form>
  <?php
  if(empty($_SESSION['login'])){
   echo'
   <div class="login">
    <p>Если у вас есть аккаунт, вы можете <a href="login.php">войти</a></p>
   </div>';
  }
  else{
    echo '
    <div class="logout">
      <form action="index.php" method="post">
        <input name="logout" type="submit" value="Выйти">
      </form>
    </div>';
  } ?>
  </div>
</body>
