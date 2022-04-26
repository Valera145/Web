<?php
header('Content-Type: text/html; charset=UTF-8');
if ($_SERVER['REQUEST_METHOD'] != 'POST'){
	print_r('Не POST методы не принимаются');
}
$errors = FALSE;
if(empty($_POST['field-name']) || empty($_POST['field-email']) || empty($_POST['year']) || empty($_POST['field-bio']) || empty($_POST['checkbox']) || $_POST['checkbox'] == false || !isset($_POST['field-super']) ){
	print_r('Заполните пустые поля!');
	exit();
}
$name = $_POST['field-name'];
$email = $_POST['field-email'];
$birth_year = $_POST['year'];
$pol = $_POST['radio-pol'];
$limbs = intval($_POST['radio-limb']);
$superpowers = $_POST['field-super'];
$bio= $_POST['field-bio'];

$bioreg = "/^\s*\w+[\w\s\.,-]*$/";
$reg = "/^\w+[\w\s-]*$/";
$mailreg = "/^[\w\.-]+@([\w-]+\.)+[\w-]{2,4}$/";
$list_sup = array('immortal','noclip','power','telepat');

if(!preg_match($reg,$name)){
	print_r('Неверный формат имени');
	exit();
}
if($limbs < 1 or !isset($limbs)){
	print_r('Неверное количество(?) конечностей');
	exit();
}
if(!preg_match($bioreg,$bio)){
	print_r('Неверный формат биографии');
	exit();
}
if(!preg_match($mailreg,$email)){
	print_r('Неверный формат email');
	exit();
}
if(!isset($pol)){
	print_r('Неверный формат пола');
	exit();
}
foreach($superpowers as $checking){
	if(array_search($checking,$list_sup)=== false){
			print_r('Неверный формат суперсил');
			exit();
	}
}

$user = 'u47594';
$pass = '1170780';
$db = new PDO('mysql:host=localhost;dbname=u47594', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
try {
  $stmt = $db->prepare("INSERT INTO application SET name=:name, mail=:mail, year=:year, sex=:sex, limb=:limb, bio=:bio");
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':mail', $email);
  $stmt->bindParam(':year', $birth_year);
  $stmt->bindParam(':sex', $pol);
  $stmt->bindParam(':limb', $limbs);
  $stmt->bindParam(':bio', $bio);
  if($stmt->execute()==false){
  print_r($stmt->errorCode());
  print_r($stmt->errorInfo());
  exit();
  }
  $id = $db->lastInsertId();
  $sppe= $db->prepare("INSERT INTO powers SET power=:power, id=:id");
  $sppe->bindParam(':id', $id);
  foreach($superpowers as $inserting){
	$sppe->bindParam(':power', $inserting);
	if($sppe->execute()==false){
	  print_r($sppe->errorCode());
	  print_r($sppe->errorInfo());
	  exit();
	}
  }
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}

print_r("Данные отправлены в бд");
?>
