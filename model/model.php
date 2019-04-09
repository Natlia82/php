<?php

class Book
{
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
	* @param $id int
	* @return mixed
	*/
	public function del($id)
	{  echo $id;
		$sth = Di::get()->db()->prepare('DELETE FROM topic WHERE id = :id');
		$sth->bindValue(':id', $id, PDO::PARAM_INT);
		return $sth->execute();
	}

	/**
	 * Удаление темы
	* @param $id int
	* @return mixed
	*/
	public function delAdmin($id)
	{  echo $id;
		$sth = Di::get()->db()->prepare('DELETE FROM admin WHERE id = :id');
		$sth->bindValue(':id', $id, PDO::PARAM_INT);
		return $sth->execute();
	}


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
	/**
	* Получение всех админив
	* @return array
	*/

 public function findAdmin() {
	 $sth = Di::get()->db()->prepare('SELECT * FROM admin');
	if ($sth->execute()) {
		return $sth->fetchAll();
	}
	return false;
 }

	public function findAllQuestion2()
	{

				$Question = Di::get()->db()->prepare('SELECT * FROM question where answer = "" ORDER BY data');
				if ($Question->execute()) {
					return $Question->fetchAll();
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
	 * Получение одного вопроса
	 * @param $id int
	 * @return array
	 */
	public function find($id)
	{  echo "model"."</br>".$id;
		$sth = Di::get()->db()->prepare("SELECT * FROM question where id = :id ");
		$sth->bindValue(':id', $id, PDO::PARAM_INT);
		$sth->execute();
		$result = $sth->fetch(PDO::FETCH_ASSOC);
	//	print_r($result);
		return $result;
	}
// сохраняем новый вопрос от пользователя
  public function insv($name, $text1, $vopros)
	{
		$sth = Di::get()->db()->prepare('INSERT INTO question (autor, question, id_topic, data) VALUES ( :name, :text1, :vopros, :date1))'
		);
		$sth->bindValue(':name', $name, PDO::PARAM_STR);
	 $sth->bindValue(':text1',$text1, PDO::PARAM_STR);
	 $sth->bindValue(':vopros', $vopros, PDO::PARAM_STR);
	 $sth->bindValue(':date1', date('dd.mm.yyyy'), PDO::PARAM_STR);
		return $sth->execute();


	}

}

 ?>
