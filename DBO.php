
<?php 
function emailcheck($email)//检查邮件地址的合法性
{ 

	$ret=false; 
	
	if(strstr($email, '@') && strstr($email, '.'))
	{ 
	
		if(eregi("^([_a-z0-9]+([._a-z0-9-]+)*)@([a-z0-9]{2,}(.[a-z0-9-]{2,})*.[a-z]{2,3})$", $email)){ 
	
		$ret=true; 

		}
	} 

 

return $ret; 

} 


class DBO
{
	private static $dbserver;
	private static $dbuser;
	private static $dbpassword;
	private static $dbo_object;
	//InitDBO
	//$dbserver:数据库服务器名
	//$dbuser:数据库用户
        //$dbpassword:数据库密码
        //无返回值

	function getInstance()
	{
		return $this->dbo_object;
	}
	
	
	
	function InitDBO($dbserver,$dbuser,$dbpassword)
	{
		$this->dbserver = $dbserver;
		$this->dbuser = $dbuser;
		$this->dbpassword = $dbpassword;
		$this->dbo_object = new DBO();
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
					mysql_close($conn);
            }
       }
		
		///
		///register函数
		///$UserName,$NickName,$Password不能为空
		///可判断用户名为空，邮箱地址不可发，昵称为空，密码为空，该用户是否已经注册过
		function register($UserName,$NickName,$Password,$Email,$Question,$Answer,$SignDetail,$HavePic,$PicName)
		{
			//echo "1";
			$error_EM_illegal = "邮箱地址不合法";
			$error_UN_isnull = "用户名为空";
			$error_NN_isnull = "昵称为空";
			$error_PS_isnull = "密码为空";
			
			$RegTime = date('Y-m-d',time());//获取注册时间
			$conn = mysql_connect($this->dbserver,$this->dbuser,$this->dbpassword);
			//echo $UserName.$NickName.$Password.$Email.$Question.$Answer.$RegTime.$SignDetail.$HavePic.$PicName;
			$sql = "call Registeration('".$UserName."','".$NickName."','".$Password."','".$Email."','".$Question."','".$Answer."','".$RegTime."','".$SignDetail."','".$HavePic."','".$PicName."',"."@result)";
			if(!emailcheck($Email))
			{
				//echo $error_EM_illegal;
				return $error_EM_illegal;
			}			
			if($UserName == NULL)
			{
				//echo $error_UN_isnull;
				return $error_UN_isnull;	
			}	
			if($NickName == NULL)
			{
				//echo $error_NN_isnull;
				return $error_NN_isnull;
			}
			if($Password == NULL)
			{
				//echo $error_PS_isnull;
				return $error_NN_isnull;
			}
			mysql_select_db("bbs_database",$conn) or die ("can't select database");
			mysql_query("SET NAMES UTF8");
			mysql_query($sql);//执行存储过程
			
			$result = mysql_query('select @result;');
			$array = mysql_fetch_array($result);
			
			//echo "2";
			
			
			
			//echo "array = ".$array[0];
			
			//echo "</br>".$sql;
			mysql_close($conn);
			return $array[0];
		}
}
?>
