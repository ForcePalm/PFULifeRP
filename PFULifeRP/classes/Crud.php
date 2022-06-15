<?php
class Crud {

    private $con;

    public function __construct(mysqli $datebase_connection)
    {
        $this->con = $datebase_connection;
    }

    public function Save($table_name, $sqlArray)
    {
        $keys = array_keys($sqlArray);
        $fields = implode(',', $keys);
        $values = "'" . implode("','", $sqlArray) . "'";
        $sql = "INSERT INTO $table_name ($fields) VALUES ($values)";
        $this->con->query($sql);
        return $this->con->insert_id;
    }

    public function Delete($table_name, $id_name, $id_value)
    {
        $sql = "DELETE FROM $table_name WHERE $id_name = $id_value";
        $this->con->query($sql);
    }

    public function Update($table_name, $sqlArray, $identifyArray)
    {
		$string = '';
        foreach ($sqlArray as $key => $value) {
        $string .= "$key = '$value',";
        }
        $string = rtrim($string, ',');
        $identifying_fields = array_keys($identifyArray);
        $identifying_field = $identifying_fields[0];
        $identifying_value = $identifyArray[$identifying_field];
        $sql = "UPDATE $table_name SET $string WHERE $identifying_field = '$identifying_value'";
        $this->con->query($sql);
        return $this->con->affected_rows;
    }

    public function UpdateWhere($table_name, $sqlArray, $identifyArray, $where_1, $where_2)
    {
        foreach ($sqlArray as $key => $value) {
        $string .= "$key = '$value',";
        }
        $string = rtrim($string, ',');
        $identifying_fields = array_keys($identifyArray);
        $identifying_field = $identifying_fields[0];
        $identifying_value = $identifyArray[$identifying_field];
        $sql = "UPDATE $table_name SET $string WHERE $identifying_field = '$identifying_value' AND $where_1 = $where_2";
        $this->con->query($sql);
        return $this->con->affected_rows;
    }

    public function Readall($table_name)
    {
        $sql = "SELECT * FROM $table_name";
        $result = $this->con->query($sql);
        return $result;
    }

    public function ReadallOrderBy($table_name, $order_by, $keyword)
    {
        $sql = "SELECT * FROM $table_name ORDER BY $order_by $keyword";
        $result = $this->con->query($sql);
        return $result;
    }

    public function ReadallOrderByLimit($table_name, $order_by)
    {
        $sql = "SELECT * FROM $table_name ORDER BY $order_by DESC LIMIT 1";
        $result = $this->con->query($sql);
        return $result;
    }

    public function Select($table_name, $id_name, $id_value)
    {
        $sql = "SELECT * FROM $table_name WHERE $id_name = $id_value";
        $result = $this->con->query($sql);
        $row = $result->fetch_object();
        return $row;
    }

    public function SelectJson($table_name, $id_name, $id_value)
    {
        $sql = "SELECT * FROM $table_name WHERE $id_name = $id_value";
        $results = $this->con->query($sql);
        $row = $results->fetch_assoc();
        $results->free_result();
        return json_encode($row);
    }

    public function SelectOrderBy($table_name, $order_by_key)
    {
        $sql = "SELECT * FROM $table_name ORDER BY $order_by_key DESC";
        $result = $this->con->query($sql);
        $row = $result->fetch_object();
        return $row;
    }

    public function SelectString($table_name, $string_name, $string_value)
    {
        $sql = "SELECT * FROM $table_name WHERE $string_name = '$string_value'";
        $result = $this->con->query($sql);
        $row = $result->fetch_object();
        return $row;
    }

    public function SelectWhere($table_name, $id_name, $id_value, $where, $where_clause)
    {
        $sql = "SELECT * FROM $table_name WHERE $id_name = $id_value AND $where = $where_clause";
        $result = $this->con->query($sql);
        $row = $result->fetch_object();
        return $row;
    }

    public function SelectAllWhere($table_name, $id_name, $id_value, $where, $where_clause)
    {
        $sql = "SELECT * FROM $table_name WHERE $id_name = $id_value AND $where = $where_clause";
        $result = $this->con->query($sql);
        return $result;
    }

    public function SelectAllWhereWhere($table_name, $id_name, $id_value, $where, $where_clause, $where2, $where_clause2)
    {
        $sql = "SELECT * FROM $table_name WHERE $id_name = $id_value AND $where = $where_clause AND $where = $where_clause";
        $result = $this->con->query($sql);
        return $result;
    }

    public function SelectAllWhereOrder($table_name, $id_name, $id_value, $where, $where_clause, $order_by, $order)
    {
        $sql = "SELECT * FROM $table_name WHERE $id_name = $id_value AND $where = $where_clause ORDER BY $order_by $keyword";
        $result = $this->con->query($sql);
        return $result;
    }

    public function SelectAll($table_name, $id_name, $id_value)
    {
        $sql = "SELECT * FROM $table_name WHERE $id_name = $id_value";
        $result = $this->con->query($sql);
        return $result;
    }

    public function SelectAllWhereOrderBy($table_name, $where_name, $where_value, $order_by, $keyword)
    {
        $sql = "SELECT * FROM $table_name WHERE $where_name = $where_value ORDER BY $order_by $keyword";
        $result = $this->con->query($sql);
        return $result;
    }

    public function SelectAllOrderBy($table_name, $order_by, $keyword)
    {
        $sql = "SELECT * FROM $table_name ORDER BY $order_by $keyword";
        $result = $this->con->query($sql);
        return $result;
    }

    public function SelectAllOrderByLimit($table_name, $order_by)
    {
        $sql = "SELECT * FROM $table_name ORDER BY $order_by ASC LIMIT 4";
        $result = $this->con->query($sql);
        return $result;
    }


    public function SelectAllOrder($table_name, $order_by)
    {
        $sql = "SELECT * FROM $table_name ORDER BY $order_by";
        $result = $this->con->query($sql);
        return $result;
    }

    public function SelectAllWhereDatetime($table_name, $where_name, $where_value, $where2_name, $where2_value, $datetime)
    {
      $sql = "SELECT * FROM $table_name WHERE $where_name = $where_value AND $where2_name < $where2_value AND $where2_name <> $where2_value AND $datetime >= CURRENT_TIMESTAMP";
      $result = $this->con->query($sql);
      return $result;
    }

    public function SelectCountWhereWhere($table_name, $count_name, $count_value, $where_name, $where_value, $where2_name, $where2_value)
    {
        $sql = "SELECT count(1) as Amount FROM $table_name WHERE $count_name = $count_value AND $where_name = $where_value AND $where2_name = $where2_value";
        $result = $this->con->query($sql);
        $row = $result->fetch_object();
        return $row;
    }

    public function SelectCount($table_name)
    {
        $sql = "SELECT count(1) as Amount FROM $table_name";
        $result = $this->con->query($sql);
        $row = $result->fetch_object();
        return $row;
    }

	public function SelectCountWhere($table_name, $where_name, $where_value)
    {
        $sql = "SELECT count(1) as Amount FROM $table_name WHERE $where_name = $where_value";
        $result = $this->con->query($sql);
        $row = $result->fetch_object();
        return $row;
    }
}
