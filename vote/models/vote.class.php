<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 2018/1/14
 * Time: 14:59
 */
class VoteModel
{
    protected $conn;
    protected $cfg;
    protected $voted_table;
    protected $vote_list_table;

    public function __construct()
    {
        $this->cfg = require(dirname(dirname(__FILE__)) . '/config.php');
        $this->conn = $this->dbConnect();
    }

    public function dbConnect()
    {
        //$host = '', $user = '', $password = '', $database = '', $port = ''
        $dbInfo = $this->cfg['db'];
        $conn = mysqli_connect($dbInfo['host'], $dbInfo['username'], $dbInfo['password'], $dbInfo['database'], $dbInfo['port']);
        return $conn;
    }

    public function getCfg($key)
    {
        return $this->cfg[$key];
    }

    public function isVoted($uid)
    {
        $date = date('Y-m-d');
        $query = "select * from {$this->voted_table} where uid='{$uid}' and `date`='{$date}'";
        $result = mysqli_query($this->conn, $query);
        if (mysqli_fetch_row($result) == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function recordVoted($uid)
    {
        $date = date('Y-m-d');
        $query = "insert into {$this->voted_table} (uid, `date`) values ('{$uid}', '{$date}')";
        if (mysqli_query($this->conn, $query)) {
            return true;
        }
        return false;
    }

    public function insertVoteList($uid, array $supports)
    {
        $created_at = date('Y-m-d H:i:s');
        $insert_sql = "insert into {$this->vote_list_table}(uid, candidate, created_at) values ";
        foreach ($supports as $support) {
            $insert_sql .= "('{$uid}', '{$support}', '$created_at'),";
        }
        $insert_sql = substr($insert_sql, 0, -1);
        mysqli_query($this->conn, $insert_sql);
    }

    public function getVoteRecords($candidate=null)
    {
        if ($candidate == null) {
            $query = "select count(candidate) as `support`, candidate from {$this->vote_list_table} GROUP BY candidate ORDER BY `support` desc";
        } else {
            $query = "select count(*) as `support`, candidatefrom {$this->vote_list_table} WHERE candidate='{$candidate}'";
        }
        $rows = mysqli_query($this->conn, $query);
        return $rows;

    }


}
