<?php
    session_start();
    
    include_once 'connection.php';
    include_once 'url.php';

    $data = $_POST;

    if(!empty($data)){

        if($data["type"] === "create"){
            $name = $data['name'];
            $phone = $data['phone'];
            $observations = $data['observations'];
            $ins = $conn->prepare("INSERT INTO contacts (name, phone, observations) VALUES (:PName, :PPhone, :PObservations)");
            try{
                $ins->execute(array(':PName'=>$name, ':PPhone'=>$phone, ':PObservations'=>$observations));
                $_SESSION['msg'] = "Contato criado com sucesso";
            } catch(PDOException $e) {
                $error = $e->getMessage();
                echo "Erro: $error";
            }
        } else if($data["type"] === "edit"){
            $id = $data['id'];
            $name = $data['name'];
            $phone = $data['phone'];
            $observations = $data['observations'];
            $update = $conn->prepare("UPDATE contacts SET name=:PName, phone=:PPhone, observations=:PObservations WHERE id=:PId");
            try{
                $update->execute(array(':PName'=>$name, ':PPhone'=>$phone, ':PObservations'=>$observations, ':PId'=>$id));
                $_SESSION['msg'] = "Cadastro editado com sucesso";
            } catch(PDOException $e) {
                $error = $e->getMessage();
                echo "Erro: $error";
            }
        } else if($data["type"] === "delete"){
            $id = $data['id'];
            $del = $conn->prepare("DELETE FROM contacts WHERE id=:PId");
            try{
                $del->execute(array(':PId'=>$id));
                $_SESSION['msg'] = "Cadastro excluido com sucesso";
            } catch(PDOException $e) {
                $error = $e->getMessage();
                echo "Erro: $error";
            }
        }
        header("Location:" . $BASE_URL . "../index.php");

    } else {
        $id;

        if(!empty($_GET)){
            $id = $_GET["id"];
        }
    
        if(!empty($id)){
    
            $sel = $conn->prepare("SELECT * FROM contacts WHERE id = :PId");
            $sel->execute(array(':PId'=>$id));
            $contact = $sel->fetch();
    
        } else {
    
            //SELECT TODOS
            $contacts = [];
    
            $sel = $conn->prepare("SELECT * FROM contacts");
            $sel->execute();
            $contacts = $sel->fetchAll();
    
        }
    }    

    $conn = null;



