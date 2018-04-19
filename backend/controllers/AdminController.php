<?php

try {
    $adminDao = new com\loabten\model\data\AdminDao(com\loabten\model\data\DatabaseUtils::connect());
    if ($action == 'detail') {
        $admin_id = $_GET['admin_id'];
        $row = $adminDao->findById($admin_id);
        include './views/admin/detail.php';
    }elseif ($action == 'add') {
        include './views/admin/add.php';
    } elseif ($action == 'add_save') {
        $adminname = $_POST['adminname'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $admin = new com\loabten\model\Admin();
        $admin->setadminname($adminname);
        $admin->setName($name);
        $admin->setPassword($password);
        $admin->setGender($gender);
        $admin->setAddress($address);
        $admin->setEmail($email);
        $admin->setPhone($phone);

        $check = $adminDao->checkadminname($adminname);
        if (isset($check[0]['adminname']) && $check[0]['adminname'] == $adminname) {
            $msg = "Admin name exits already!";
            include './views/admin/add.php';
        } else {
            $result = $adminDao->insert($admin);         
            $msg = "$result admin has been inserted";
            $result = $adminDao->findAll();
            include './views/admin/list.php';
        }    
    } elseif ($action == 'delete') {
        $admin_id = $_GET['admin_id'];
        
        $result = $adminDao->delete($admin_id);
        $alert_message = 'The admin has been deleted!!';
        $result = $adminDao->findAll();
        include './views/admin/list.php';
    } elseif ($action == 'edit') {
        $admin_id = $_GET['admin_id'];
        $row = $adminDao->findById($admin_id);

        $msg = "";
        include './views/admin/edit.php';
    } elseif ($action == 'edit_save') {
        $admin_id = $_POST['admin_id'];
        $adminname = $_POST['adminname'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $admin = new com\loabten\model\admin();
        $admin->setadmin_id($admin_id);
        $admin->setadminname($adminname);
        $admin->setName($name);
        $admin->setPassword($password);
        $admin->setGender($gender);
        $admin->setAddress($address);
        $admin->setEmail($email);
        $admin->setPhone($phone);

        $adminDao->update($admin);
        $msg = 'The admin has been updated!';
        $result = $adminDao->findAll();
        include './views/admin/list.php';
    } elseif ($action == 'find') {
        $result = NULL;
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
            $result = $adminDao->findByName($name);
            if (empty($result)) {
                $msg = "There aren't any admin";
            }
        } else {
            $result = $adminDao->findAll();
        }
        include './views/admin/find.php';
    } elseif ($action == 'list') { //
        $result = $adminDao->findAll();
        include './views/admin/list.php';
    }
} catch (Exception $exc) {
    $error = $exc->getMessage();
}