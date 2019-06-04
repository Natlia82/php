<?php
class Admin
{

	/**
	* Получение всех тем
	* @return array
	*/
	public function topicsAll()
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
	public function QuestionAll()
	{
		$Question = Di::get()->db()->prepare('SELECT * FROM question');
		if ($Question->execute()) {
			return $Question->fetchAll();
		}
		return false;
	}

	/**
	* Добавление новой темы
	* $name название темы
	*/
	public function topicsAdd($name)
	{
		$sth = Di::get()->db()->prepare('INSERT INTO topic (mane) VALUES(:name)'
	);
	$sth->bindValue(':name', $name, PDO::PARAM_STR);

	return $sth->execute();
}

/** добавление администратора
**$name логин
** $passw пароль
**/

public function addadmin($name, $passw)
{
	$sth = Di::get()->db()->prepare('INSERT INTO admin (login, password) VALUES( :name, :passw)'
);
$sth->bindValue(':name', $name, PDO::PARAM_STR);
$sth->bindValue(':passw', $passw, PDO::PARAM_STR);
return $sth->execute();
}

/**
* Удаление темы
* $id id-темы
*/
public function del($id)
{
	$sth = Di::get()->db()->prepare('DELETE FROM topic WHERE id = :id');
	$sth->bindValue(':id', $id, PDO::PARAM_INT);
	return $sth->execute();
}

/**
* Удаление администратора
* $id id администратора
*/
public function AdminDelete($id)
{
	$sth = Di::get()->db()->prepare('DELETE FROM admin WHERE id = :id');
	$sth->bindValue(':id', $id, PDO::PARAM_INT);
	return $sth->execute();
}

/**
* Получение всех админив
*
*/

public function AdminAll() {
	$sth = Di::get()->db()->prepare('SELECT * FROM admin');
	if ($sth->execute()) {
		return $sth->fetchAll();
	}
	return false;
}

/**получение массива вопросов без ответа отсортированных по дате
** все вопросы у которых нет ответа (where answer = "")
** отсортированы па дате вопроса (ORDER BY data)
*/
public function QuestionAllSorted()
{

	$question = Di::get()->db()->prepare('SELECT * FROM question where answer = "" ORDER BY data');
	if ($question->execute()) {
		return $question->fetchAll();
	}
	return false;

}
/**функция ищет есть ли такой пароль в базе
* $log  логин
*$pas пароль
**/
public function  adminPassword($log, $pas)
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
*$id id администратора
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
**редактирование информации о админе
**$logi логин
**$pass пароль
**$param id администратора
**/
public function adminUpdate($logi, $pass, $param)
{
	$sth = Di::get()->db()->prepare("UPDATE admin SET login = :logi, password = :pass
		WHERE id = :param");
		$sth->bindValue(':logi', $logi, PDO::PARAM_STR);
		$sth->bindValue(':pass', $pass, PDO::PARAM_STR);
		$sth->bindValue(':param', $param, PDO::PARAM_INT);
		return $sth->execute();
	}



}

?>
