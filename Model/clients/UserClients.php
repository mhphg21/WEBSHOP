<?php
// xử lý thêm tài khoản và check đăng nhập
require_once './Model/Pdo.php';

class UserClients
{
    public function addUser($name, $email, $password, $avatar, $phone, $address)
    {
        $sql =  "INSERT INTO users(name, email, password, avatar, phone, address, role_id)
        VALUES (?, ?, ?, ?, ?, ?, 3)";
        pdo_execute($sql, $name, $email, $password, $avatar, $phone, $address);
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        return pdo_query_one($sql, $email);
    }


    public function updatePassword($email, $passwordHash)
    {
        $sql = "UPDATE users SET password =? WHERE email = ? ";
        pdo_execute($sql, $passwordHash, $email);
    }

    function checkEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $result = pdo_query_one($sql, $email);
        return $result ? true : false;
    }

    public function list_category()
    {
        $query = "SELECT * FROM `categories`";
        $result = pdo_query($query);
        return $result;
    }



    //lấy thông tin của người dùng dựa trên user_id
    public function getUserById($id)
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        return pdo_query_one($sql, $id);
    }

    /*     public function profileUser($name, $email, $avatar, $phone, $address)
    {
        $sql = "SELECT * FROM users WHERE name = ? AND email = ? AND avatar = ? AND phone = ? 
        AND address = ? ";
        return pdo_query_one($sql, $name, $email, $avatar, $phone, $address);
        
    } */

    public function updateUserProfile($id, $name, $email, $avatar, $phone, $address)
    {
        $sql = "UPDATE users SET name = ?, email = ?, avatar = ?, phone = ?, address = ? WHERE id = ?";
        pdo_execute($sql, $name, $email, $avatar, $phone, $address, $id);
    }

    //đổi mk trong profile
    public function updatePasswordById($id, $passwordHash)
    {
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        pdo_execute($sql, $passwordHash, $id);
    }
}
