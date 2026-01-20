<?php

class Leave
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

       public function apply($user_id, $data)
    {
        $stmt = mysqli_prepare($this->conn, "
            INSERT INTO leave_requests
            (user_id, leave_type, day_type, from_date, to_date, reason, emergency_name, emergency_phone)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        mysqli_stmt_bind_param(
            $stmt,
            "isssssss",
            $user_id,
            $data['leave_type'],
            $data['day_type'],
            $data['from_date'],
            $data['to_date'],
            $data['reason'],
            $data['emergency_name'],
            $data['emergency_phone']
        );

        return mysqli_stmt_execute($stmt);
    }

   
    public function getHistory($user_id)
    {
        $stmt = mysqli_prepare($this->conn, "
            SELECT * FROM leave_requests
            WHERE user_id=?
            ORDER BY created_at DESC
        ");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $history = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $history[] = $row;
        }

        return $history;
    }
}
