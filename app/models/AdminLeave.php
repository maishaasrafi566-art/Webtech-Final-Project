<?php

class AdminLeave
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

   
    public function getAllLeaves()
    {
        $stmt = mysqli_prepare(
            $this->conn,
            "SELECT l.*, u.name AS employee_name, u.email, u.phone
             FROM leave_requests l
             JOIN users u ON l.user_id = u.id
             ORDER BY l.created_at DESC"
        );
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $leaves = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $leaves[] = $row;
        }

        return $leaves;
    }

    
    public function updateStatus($id, $status)
    {
        $stmt = mysqli_prepare(
            $this->conn,
            "UPDATE leave_requests SET status=? WHERE id=?"
        );
        mysqli_stmt_bind_param($stmt, "si", $status, $id);
        return mysqli_stmt_execute($stmt);
    }
}
