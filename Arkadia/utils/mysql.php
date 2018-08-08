<?
/*    
    Файл mysql.incl
    Класс для упрощенной работы с MySQL
    (c) Eugene Bond
*/    
class DB {
    var $db;
	
    
    //    
    //    Конструктор. Принимает параметры для подключения к базе и имя БД
    //    
    function DB($host, $user, $pass, $base="") //подключение к бд
	{
        if ($base=="")
			$base=$user;        //    Если имя БД не задано, устанавливаем его равным имени пользователя
        $this -> db = mysqli_connect($host, $user, $pass) or die("Не могу подключится к MySQL");
        mysqli_select_db( $this -> db, $base) or die('Не могу выбрать базу данных');
    }
    
    //    
    //    Унификатор запроса к БД
    //    
		function request($sql) //функция для выполнения запросов. Запрос - $sql
		{
			$res = mysqli_query($this -> db,$sql);
			if ($res) 
				return $res;
			else 
			{
				$err = "<BR><FONT COLOR=red>Ошибка при выполнении запроса:</FONT><BR><FONT COLOR=#0000FF>".$sql."</FONT><BR><FONT COLOR=#FF0000>".mysqli_error($this->db)."</FONT><BR>";
				echo $err;
			}
        return 0;
    }
    
    //    
    //    Запрос к БД. Текст запроса передается переметром $sql
    //    Если параметр $r равен 1 - возвращаем массив записей, если 0 - возвращаем массив одной записи
    //    Параметр $type отвечает за то, в каком виде будет вернувшийся массив. См. ман!
    //
    function select($sql, $assoc='') 
	{
		$ret = array();
		$res = $this -> request($sql);
		for($i=0; $i<mysqli_num_rows($res);$i++) 
		{
			$row = mysqli_fetch_assoc($res);//возвращает ряд результата запроса в качестве ассоциативного массива
			if($assoc && $assoc!==true && isset($row[$assoc]))//isset или не NULL
				$ret[$row[$assoc]] = $row;
			else
				$ret[] = $row;
    }
    mysqli_free_result($res);
    if(sizeof($ret)==1 && $assoc===true)
        return $ret[0];
    return $ret;
}
    
    //    
    //    Запрос к БД. Текст запроса передается переметром $sql
    //    Если параметр $r равен 1 - возвращаем ассоциативный массив, если 0 - возвращаем одно значение
    //
    function a_select($sql, $r=1) 
	{
        if ($res = $this->request($sql)) 
		{
            if ($r) 
			{
                while ($res_arr = mysqli_fetch_row($res)) 
					$ret_arr[$res_arr[0]]=$res_arr[1];
            } 
			//mysql_fetch_row Возвращает массив с числовыми индексами, содержащий данные обработанного ряда, и сдвигает внутренний указатель результата вперед.
			else 
			{
                $res_arr = mysqli_fetch_row($res);
                //$ret_arr = $res_arr[0];
                $ret_arr = $res_arr;
            }
            return $ret_arr;
        }
        return 0;
    }
    

    
    
    //    
    //    Изменение одной записи. Если $cur_id равен 0 - вставляем новую запись в таблицу $cur_tbl,
    //    Если $cur_id не равен 0 - меняем запись с id равным $cur_id.
    //    $osql - список изменяемых полей в формате "field1='value1', field2='value2', ..."
    //    Если $block==true - блокируем таблицу на время операции
    //
	/*
    function modify($osql, $cur_tbl, $cur_id, $block=false) 
	{
        $sql=(($cur_id)?"UPDATE":"INSERT")." $cur_tbl SET ".$osql;
        if ($cur_id) 
			$sql .= " WHERE id=$cur_id";
        if ($block) 
			mysql_query("LOCK TABLES ".$cur_tbl." WRITE");
        if ($res=$this->request($sql)) 
		{
            if (!$cur_id) $cur_id=mysql_insert_id();
        }
        if ($block) 
			mysql_query("UNLOCK TABLES");
		return $cur_id;
    }
	*/
	function last_id()
	{
		$res = mysqli_insert_id($this -> db);
		
		return $res;
	}
}
?>