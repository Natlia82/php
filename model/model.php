<?php
class Topic
{

	/**
	* Получение всех тем
	* @return array
	*/
	public function findAll()
	{
		$sth = Di::get()->db()->prepare('SELECT * FROM topic');
		if ($sth->execute()) {
			return $sth->fetchAll();
		}
		return false;
	}
	/**
	* Получение всех вопросов
	* @return array
	*/
	public function findAllQuestion()
	{
		$Question = Di::get()->db()->prepare('SELECT * FROM question');
		if ($Question->execute()) {
			return $Question->fetchAll();
		}
		return false;
	}
	// сохраняем новый вопрос от пользователя
	public function insv($name, $text1, $vopros)
	{
		$data = date('d.m.Y');
		$sql = "INSERT INTO question (autor, question, id_topic, data) VALUES ( '".$name."', '".$text1."', '".$vopros."', '".$data."')";
		$sth = Di::get()->db()->prepare($sql);
		return $sth->execute();
	}
	/**
	* Добавление новой темы
	*
	*/
	public function add($name)
	{
		$sth = Di::get()->db()->prepare('INSERT INTO topic (mane) VALUES(:name)'
	);
	$sth->bindValue(':name', $name, PDO::PARAM_STR);

	return $sth->execute();
}
//добавление администратора
public function addadmin($name, $passw)
{
	$sth = Di::get()->db()->prepare('INSERT INTO admin (login, password) VALUES( :name, :passw)'
);
$sth->bindValue(':name', $name, PDO::PARAM_STR);
$sth->bindValue(':passw', $passw, PDO::PARAM_STR);
return $sth->execute();
}
//функция изменения админимтсратора
public function updadm($param)
{

}

/**
* Удаление темы
*
*/
public function del($id)
{
	$sth = Di::get()->db()->prepare('DELETE FROM topic WHERE id = :id');
	$sth->bindValue(':id', $id, PDO::PARAM_INT);
	return $sth->execute();
}

/**
* Удаление администратора
*
*/
public function delAdmin($id)
{
	$sth = Di::get()->db()->prepare('DELETE FROM admin WHERE id = :id');
	$sth->bindValue(':id', $id, PDO::PARAM_INT);
	return $sth->execute();
}

/**
* Получение всех админив
*
*/

public function findAdmin() {
	$sth = Di::get()->db()->prepare('SELECT * FROM admin');
	if ($sth->execute()) {
		return $sth->fetchAll();
	}
	return false;
}
//получение массива вопросов без ответа отсортированных по дате
public function findAllQuestion2()
{

	$question = Di::get()->db()->prepare('SELECT * FROM question where answer = "" ORDER BY data');
	if ($question->execute()) {
		return $question->fetchAll();
	}
	return false;

}
/**
*
* функция ищет есть ли такой пароль в базе
**/
public function  adminInput($log, $pas)
{
	$pass = Di::get()->db()->prepare('SELECT * FROM `admin` WHERE `login` = :log AND `password` = :pass ');
	$pass->bindValue(':log', $log, PDO::PARAM_STR);
	$pass->bindValue(':pass', $pas, PDO::PARAM_STR);

	if ($pass->execute()) {
		return $pass->fetchAll();
	}
	return false;

}

/**
* получение информации об админе
**/

public function adminfind($id)
{
	$sth = Di::get()->db()->prepare("SELECT * FROM admin where id = :id ");
	$sth->bindValue(':id', $id, PDO::PARAM_INT);
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	return $result;
}


/**
* Получение одного вопроса для дальнейшего редактирования
*
*/
public function find($id)
{
	$sth = Di::get()->db()->prepare("SELECT * FROM question where id = :id ");
	$sth->bindValue(':id', $id, PDO::PARAM_INT);
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	return $result;
}
/**
* Удаление вопроса
*
*/
public function deleteQuestion($id)
{
	$sth = Di::get()->db()->prepare('DELETE FROM question WHERE id = :id');
	$sth->bindValue(':id', $id, PDO::PARAM_INT);
	return $sth->execute();
}

/**
**редактирование информации о админе
**/
public function admUpdateQuestion($logi, $pass, $param)
{
	$sql =  "UPDATE admin SET login = '".$logi."', password ='".$pass."' WHERE id =".$param;
	$sth = Di::get()->db()->prepare($sql);
	$sth->bindValue(':id', $id, PDO::PARAM_INT);
	return $sth->execute();
}

/**
* редактирование вопроса
*/
public function updateQuestion($question, $answer, $status, $option, $autor, $id)
{
	$sql = "UPDATE question SET question = '".$question."', answer ='".$answer."', status= '".$status;
	if ($option !== "") {
		$sql .= "', id_topic= '".$option;
	}
	$sql .= "',	autor= '".$autor."' WHERE id =".$id;
	$sth = Di::get()->db()->prepare($sql);
	$sth->bindValue(':id', $id, PDO::PARAM_INT);
	return $sth->execute();
}

}

?>
