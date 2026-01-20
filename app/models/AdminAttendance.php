<?php

class AdminAttendance
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllAttendance()
    {
        $stmt = mysqli_prepare(
            $this->conn,
            "SELECT a.*, u.name AS employee_name 
             FROM attendance a
             JOIN users u ON a.user_id = u.id
             ORDER BY a.punch_in DESC"
        );
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $records = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $records[] = $row;
        }

        return $records;
    }

    public function updateStatus($id, $status)
    {
        $stmt = mysqli_prepare(
            $this->conn,
            "UPDATE attendance SET status=?, reviewed_at=NOW() WHERE id=?"
        );
        mysqli_stmt_bind_param($stmt, "si", $status, $id);
        return mysqli_stmt_execute($stmt);
    }
}
