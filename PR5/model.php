<?php
$model=new model();
if(isset($_POST['ProtectQuery'])){
    $id=$_POST['ProtectQuery'];
    echo json_encode($model->getValueProtect($id));
}elseif(isset($_POST['NoProtectQuery'])) {
    $id=$_POST['NoProtectQuery'];
    echo json_encode($model->getValueNoProtect($id));
}
class model
{
    private PDO $connection;
    public function __construct()
    {
        try {
            $this->connection = new PDO('pgsql:host=localhost;port=5435;user=postgres;password=290677;dbname=postgres');
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            throw $e;
        }
    }
    public function getValueProtect($data){
        $sql="Select * from users where id=:id";
        try{
            $prepared=$this->connection->prepare($sql);
            $prepared->bindParam(':id',$data);
            $prepared->execute();
            return $prepared->fetchAll();
        }catch (Exception $e){
            return['error'=>true];
        }
    }
    public function getValueNoProtect($data){
        $sql="Select * from users where id=".$data;
        try{
            $prepared=$this->connection->prepare($sql);
            $prepared->execute();
            return $prepared->fetchAll();
        }catch (Exception $e){
            return['error'=>true];
        }
    }
}
