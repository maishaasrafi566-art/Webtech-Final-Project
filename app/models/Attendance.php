<?php

class Attendance
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function punchIn($user_id, $work_type)
    {
        $stmt = mysqli_prepare($this->conn, "
            SELECT id FROM attendance
            WHERE user_id=? AND DATE(punch_in)=CURDATE()
        ");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) === 0) {
            $currentTime = date("H:i:s");
            $status = ($currentTime <= "09:15:00") ? "In-Time" : "Late";

            $stmt_insert = mysqli_prepare($this->conn, "
                INSERT INTO attendance (user_id, punch_in, work_type, status)
                VALUES (?, NOW(), ?, ?)
            ");
            mysqli_stmt_bind_param($stmt_insert, "iss", $user_id, $work_type, $status);
            mysqli_stmt_execute($stmt_insert);
            return "✅ Punch In successful ($status)";
        } else {
            return "⚠️ Already punched in today";
        }
    }

    public function punchOut($user_id)
    {
        $stmt = mysqli_prepare($this->conn, "
            UPDATE attendance
            SET punch_out=NOW()
            WHERE user_id=? AND DATE(punch_in)=CURDATE()
            ORDER BY id DESC LIMIT 1
        ");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        return "✅ Punch Out successful";
    }

    public function getTodayAttendance($user_id)
    {
        $stmt = mysqli_prepare($this->conn, "
            SELECT * FROM attendance
            WHERE user_id=? AND DATE(punch_in)=CURDATE()
            ORDER BY id DESC LIMIT 1
        ");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

       public function getAttendanceHistory($user_id)
    {
        $stmt = mysqli_prepare($this->conn, "
            SELECT * FROM attendance
            WHERE user_id=?
            ORDER BY punch_in DESC
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
