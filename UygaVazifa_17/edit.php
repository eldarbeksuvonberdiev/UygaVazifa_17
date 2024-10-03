<?php
include "Talabalar.php";

$id = $_GET['id'];

$talaba = Talabalar::getOne($id);

if(isset($_POST['add']) && !empty($_POST['fio']) && !empty($_POST['tel']) && !empty($_POST['manzil'])) {
    
    global $talaba;

    if(empty($_FILES['rasm'])){
        $rasmP = $talaba['img'];
    }else{
        $rasm = explode('.',$_FILES['rasm']['name']);
        $rasmP = 'images/'.date("Y-m-d_H-i-s.").end($rasm);
        move_uploaded_file($_FILES['rasm']['tmp_name'],$rasmP);
    }
    $fio = $_POST['fio'];
    $tel = $_POST['tel'];
    $manzil = $_POST['manzil'];

    $talaba1 = Talabalar::update($id,$fio,$tel,$manzil,$rasmP);
    if($talaba1){
        header("location:index.php");
    }
}

?>

<form action="" align="center" method="POST" enctype="multipart/form-data" style="margin-top:100px">
            <label for="">FIO:</label>
            <input type="text" name="fio" value="<?=$talaba['fio']?>"><br><br>
            <label for="">Telefon raqami:</label>
            <input type="text" name="tel" value="<?=$talaba['tel']?>"><br><br>
            <label for="">Manzil:</label>
            <input type="text" name="manzil" value="<?=$talaba['manzil']?>"><br><br>
            <label for="">Rasm:</label>
            <img src="<?=$talaba['img']?>" width="100" alt=""><br><br>
            <input type="file" name="rasm"><br><br>
            <input type="submit" value="Submit" name="add"><br><br>
</form>