<?php
include "Talabalar.php";

$talabalar = Talabalar::getAll();

if(isset($_POST['add']) && !empty($_POST['fio']) && !empty($_POST['tel']) && !empty($_POST['manzil']) && !empty($_FILES['rasm'])) {
    
    // print_r($_POST);
    $fio = $_POST['fio'];
    $tel = $_POST['tel'];
    $manzil = $_POST['manzil'];
    $rasm = explode('.',$_FILES['rasm']['name']);
    $rasmP = 'images/'.date("Y-m-d_H-i-s.").end($rasm);
    print_r($rasmP);
    move_uploaded_file($_FILES['rasm']['tmp_name'],$rasmP);

    $talaba = Talabalar::create($fio,$tel,$manzil,$rasmP);
    echo $talaba;
    if($talaba){
        header("location:index.php");
    }
}

if(isset($_GET['del'])){
    $id = $_GET['del'];
    if($talaba = Talabalar::delete($id)){
        header("location:index.php");
    }
}

?>


<table border="1" align="center" style="margin-top: 50px;border-radius:10px" width="80%">
    <tr>
        <th>ID</th>
        <th>FIO</th>
        <th>Tel</th>
        <th>Manzil</th>
        <th>Rasm</th>
        <th>Edit/Delete</th>
    </tr>
    <?php
        foreach ($talabalar as $talaba) { ?>
            <tr>
                <td><?=$talaba['id']?></td>
                <td><?=$talaba['fio']?></td>
                <td><?=$talaba['tel']?></td>
                <td><?=$talaba['manzil']?></td>
                <td><img src="<?=$talaba['img']?>" width="100" alt=""></td>
                <td>
                    <a href="edit.php?id=<?=$talaba['id']?>">Edit</a>
                    <a href="?del=<?=$talaba['id']?>">Delete</a>
                </td>
            </tr>
       <?php }
    ?>
</table><br><br>


<form action="" align="center" method="POST" enctype="multipart/form-data">
            <label for="">FIO:</label>
            <input type="text" name="fio" placeholder="fio"><br><br>
            <label for="">Telefon raqami:</label>
            <input type="text" name="tel" placeholder="tel"><br><br>
            <label for="">Manzil:</label>
            <input type="text" name="manzil" placeholder="Manzil"><br><br>
            <label for="">Rasm:</label>
            <input type="file" name="rasm"><br><br>
            <input type="submit" value="Submit" name="add"><br><br>
</form>