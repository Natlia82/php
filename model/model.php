<?php
class Model
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
	public function questionAll()
	{
		$Question = Di::get()->db()->prepare('SELECT * FROM question');
		if ($Question->execute()) {
			return $Question->fetchAll();
		}
		return false;
	}

	/** сохраняем новый вопрос от пользователя
	**$name имя автора
	** $text1 текст вопроса
	** $vopros тема (id)
	**/
	public function questionInsert($name, $text1, $vopros)
	{
		$data = date('d.m.Y');
		$sth = Di::get()->db()->prepare("INSERT INTO question (autor, question, id_topic, data)
		VALUES ( :name, :text1, :vopros, :data)");
		$sth->bindValue(":name", "$name", PDO::PARAM_STR);
		$sth-> bindValue(":text1", "$text1", PDO::PARAM_STR);
		$sth->bindValue(":vopros", "$vopros", PDO::PARAM_INT);
		$sth->bindValue(":data", "$data", PDO:: PARAM_STR);
		return $sth->execute();
	}

	

}

?>
