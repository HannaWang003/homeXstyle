<?php
date_default_timezone_set('Asia/Taipei');
session_start();
//2
function dd($ary)
{
    echo "<pre>";
    print_r($ary);
    echo "</pre>";
}
function to($url)
{
    header("location:$url");
}
//
class DB
{
    //3
    protected $table;
    protected $pdo;
    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=program-homeXstyle";
    //construct
    function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, 'root', '');
    }
    //3
    private function a2s($ary)
    {
        foreach ($ary as $col => $val) {
            $tmp[] = "`$col`='$val'";
        }
        return $tmp;
    }
    private function sql_all($sql, $where, $other)
    {
        if (is_array($where)) {
            $sql .= " where " . join(" && ", $this->a2s($where));
        } else {
            $sql .= " $where";
        }
        $sql .= " $other";
        return $sql;
    }
    private function math($math, $col, $where = "", $other = "")
    {
        $sql = "select $math(`$col`) from `$this->table` ";
        $sql = $this->sql_all($sql, $where, $other);
        return $this->pdo->query($sql)->fetchColumn();
    }
    function all($where = '', $other = '')
    {
        $sql = "select * from `$this->table` ";
        $sql = $this->sql_all($sql, $where, $other);
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
$Carousel = new DB('carousel');
