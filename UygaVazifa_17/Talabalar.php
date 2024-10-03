<?php
include "DataBase.php";

class Category extends DataBase
{

    protected static $id;
    protected static $name;
    protected static $tel;
    protected static $manzil;
    protected static $img;

    public static $table = "talabalar";

    public static function getAll()
    {
        $query = "SELECT * FROM " . self::$table;
        $stmt = self::connect()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function getOne($id)
    {
        self::$id = $id;
        $query = "SELECT * FROM " . self::$table . " WHERE id = :id";
        $stmt = self::connect()->prepare($query);
        $stmt->bindParam(":id",self::$id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function delete($id)
    {        
        self::$id = $id;
        $query = "DELETE FROM " . self::$table . " WHERE id = :id";
        $stmt = self::connect()->prepare($query);
        $stmt->bindParam(":id",self::$id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($name,$tel,$manzil,$img)
    {
        self::$name = $name;
        self::$tel = $tel;
        self::$manzil = $manzil;
        self::$img = $img;

        $query = "INSERT INTO " . self::$table . "(fio,tel,manzil,img) VALUES (:fio,:tel,:manzil,:img)";
        $stmt = self::connect()->prepare($query);
        $stmt->bindParam(":fio",self::$name);
        $stmt->bindParam(":tel",self::$tel);
        $stmt->bindParam(":manzil",self::$manzil);
        $stmt->bindParam(":img",self::$img);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($id,$name,$tel,$manzil,$img)
    {
        self::$id = $id;
        self::$name = $name;
        self::$tel = $tel;
        self::$manzil = $manzil;
        self::$img = $img;

        $query = "UPDATE " . self::$table . " SET fio=:fio, tel=:tel, manzil=:manzil,img=:img WHERE id=:id ";
        $stmt = self::connect()->prepare($query);
        $stmt->bindParam(":id",self::$id);
        $stmt->bindParam(":fio",self::$name);
        $stmt->bindParam(":tel",self::$tel);
        $stmt->bindParam(":manzil",self::$manzil);
        $stmt->bindParam(":img",self::$img);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}

echo "<pre>";
print_r(Category::getAll());
echo "</pre>";

// Category::$id = 1;
echo "<pre>";
print_r(Category::getOne(6));
echo "</pre>";

// echo "<pre>";
// print_r(Category::delete());
// echo "</pre>";

// echo "<pre>";
// Category::create("Allisher","+998990001122","Andijon","images/1.jpg");
// echo "</pre>";

// echo "<pre>";
// Category::update(6,"Nargiza","+998911234567","Namangan","images/2.jpg");
// echo "</pre>";