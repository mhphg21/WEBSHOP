<?php
class User
{
    public function getListUser()
    {
        $query = "SELECT 
    users.id,
    users.name,
    users.email,
    roles.name AS role_name,
    users.phone,
    users.address,
    users.status,
    users.created_at,
    users.updated_at
    FROM users
    JOIN roles ON users.role_id = roles.id
    where roles.name = 'customers'
    order by users.id desc;";
        $result = pdo_query($query);
        return $result;
    }

    public function searchUsers($username, $email, $role, $phone, $address, $status, $from_date, $to_date, $page, $limit)
    {
        $start = ($page - 1) * $limit;
        $sql = "SELECT 
            users.id,
            users.name,
            users.email,
            r.name AS role_name,
            users.phone,
            users.address,
            users.status,
            users.created_at,
            users.updated_at
        FROM users
        JOIN roles r ON users.role_id = r.id
        WHERE 1 = 1";
        $params = [];

        if (!empty($username)) {
            $sql .= " AND users.name LIKE :username";
            $params[':username'] = '%' . $username . '%';
        }

        if (!empty($email)) {
            $sql .= " AND email LIKE :email";
            $params[':email'] = '%' . $email . '%';
        }

        if (!empty($role)) {
            $sql .= " AND r.name LIKE :role";
            $params[':role'] = '%' . $role . '%';
        }

        if (!empty($phone)) {
            $sql .= " AND phone LIKE :phone";
            $params[':phone'] = '%' . $phone . '%';
        }

        if (!empty($address)) {
            $sql .= " AND address LIKE :address";
            $params[':address'] = '%' . $address . '%';
        }

        if (!empty($status)) {
            $sql .= " AND status = :status";
            $params[':status'] =  $status;
        }

        if (!empty($from_date)) {
            $sql .= " AND DATE(created_at) >= :from_date";
            $params[':from_date'] = $from_date;
        }

        if (!empty($to_date)) {
            $sql .= " AND DATE(created_at) <= :to_date";
            $params[':to_date'] = $to_date;
        }

        $sql .= " ORDER BY users.id DESC LIMIT $start, $limit";

        // Thực thi truy vấn
        $result =  pdo_query2($sql, $params);
        // print_r($result);
        // die();
        return $result;
    }


    public function getUSerById($idUser)
    {
        $querry = "SELECT 
            users.id,
            users.name,
            users.email,
            users.role_id,
            r.name AS role_name,
            users.phone,
            users.address,
            users.status,
            users.created_at,
            users.updated_at
        FROM users  
        JOIN roles r ON users.role_id = r.id
        WHERE users.id = ?";
        $result = pdo_query_one($querry, $idUser);
        return $result;
    }

    public function getRole()
    {
        $querry = "SELECT * from roles";
        $result = pdo_query($querry);
        return $result;
    }


    public function editUser($status, $role, $updated_at, $idUser)
    {
        $querry = "UPDATE users SET status = ?, role_id = ?, updated_at = ? WHERE id = ?";
        pdo_execute($querry, $status, $role, $updated_at, $idUser);
    }

    public function countFilteredUsers($username, $email, $role, $phone, $address, $status, $from_date, $to_date)
    {
        $sql = "SELECT COUNT(*) as total FROM users 
            JOIN roles r ON users.role_id = r.id
            WHERE 1 = 1";
        $params = [];

        if (!empty($username)) {
            $sql .= " AND users.name LIKE :username";
            $params[':username'] = '%' . $username . '%';
        }

        if (!empty($email)) {
            $sql .= " AND email LIKE :email";
            $params[':email'] = '%' . $email . '%';
        }

        if (!empty($role)) {
            $sql .= " AND r.name LIKE :role";
            $params[':role'] = '%' . $role . '%';
        }

        if (!empty($phone)) {
            $sql .= " AND phone LIKE :phone";
            $params[':phone'] = '%' . $phone . '%';
        }

        if (!empty($address)) {
            $sql .= " AND address LIKE :address";
            $params[':address'] = '%' . $address . '%';
        }

        if (!empty($status)) {
            $sql .= " AND status = :status";
            $params[':status'] =  $status;
        }

        if (!empty($from_date)) {
            $sql .= " AND DATE(created_at) >= :from_date";
            $params[':from_date'] = $from_date;
        }

        if (!empty($to_date)) {
            $sql .= " AND DATE(created_at) <= :to_date";
            $params[':to_date'] = $to_date;
        }

        $result = pdo_query_one_with_params($sql, $params);
        return (int) $result['total'];
    }

    public function countUser()
    {
        $querry = "SELECT COUNT(*) as total
            FROM users 
            JOIN roles r ON users.role_id = r.id 
            where r.name = 'customers'";
        $result = pdo_query_one($querry);
        return (int) $result['total'];
    }
}

