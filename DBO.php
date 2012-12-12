
<?php 
class DBO
{
	private $dbserver;
	private $dbuser;
	private $dbpassword;
	
	//InitDBO
	//$dbserver:数据库服务器名
	//$dbuser:数据库用户
        //$dbpassword:数据库密码
        //无返回值
	function InitDBO($dbserver,$dbuser,$dbpassword)
	{
		$this->dbserver = $dbserver;
		$this->dbuser = $dbuser;
		$this->dbpassword = $dbpassword;
		
		//$this->$dbpassword = $dbpassword;
	}
	
	//LoginCheck
        //$username:用户名
        //$password:密码
        //返回值:$array数组。
        //使用范例：$array = $object->LoginCheck($username,$password);
	function LoginCheck($username,$password)//三种返回值  正确 ， 密码错误 ， 用户不存在
	{
		//$conn = mysql_connect("localhost", "root","");
		//$conn = mysql_connect("localhost","root","");
	$conn = mysql_connect($this->dbserver,$this->dbuser,$this->dbpassword);
	//mysql_query("SET NAMES 'gb2312'",$conn); 
            if($conn)
            {
                mysql_select_db("bbs_database",$conn) or die ("can't select database");
               //echo "DataBase is OK!";


                    $sql = "call LoginCheck('".$username."','".$password."',"."@result".");";
                    //echo $sql;
                    mysql_query($sql);
                    $result = mysql_query('select @result;');
                    $array = mysql_fetch_array($result);
                            //echo '<pre>';print_r($array);
                    return $array;

            }
        }
}
?>
