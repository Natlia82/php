<?php
class Questions
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
	* Получение одного вопроса для дальнейшего редактирования
	* $id id вопроса
	*/
	public function  Questionsfind($id)
	{
		$sth = Di::get()->db()->prepare("SELECT * FROM question where id = :id ");
		$sth->bindValue(':id', $id, PDO::PARAM_INT);
		$sth->execute();
		$result = $sth->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	/**
	* Удаление вопроса
	* $id id вопроса
	*/
	public function deleteQuestion($id)
	{
		$sth = Di::get()->db()->prepare('DELETE FROM question WHERE id = :id');
		$sth->bindValue(':id', $id, PDO::PARAM_INT);
		return $sth->execute();
	}


	/**
	* редактирование вопроса
	* $question вопрос
	* $answer ответ
	* $status статус(отвечен, нет)
	* $option id темы
	* $autor автор
	* $id id вопроса
	*/
	public function updateQuestion($question, $answer, $status, $option, $autor, $id)
	{
		if ($option !== "") {
			$sth = Di::get()->db()->prepare("UPDATE question SET question = :question, answer = :answer,
				status= :status, autor= :autor, id_topic= :option WHERE id = :id");
				$sth->bindValue(':option', $option, PDO::PARAM_INT);
			} else {
				$sth = Di::get()->db()->prepare("UPDATE question SET question = :question, answer = :answer,
					status= :status, autor= :autor WHERE id = :id");
				}
				$sth->bindValue(':question', $question, PDO::PARAM_STR);
				$sth->bindValue(':answer', $answer, PDO::PARAM_STR);
				$sth->bindValue(':status', $status, PDO::PARAM_INT);
				$sth->bindValue(':autor', $autor, PDO::PARAM_STR);
				$sth->bindValue(':id', $id, PDO::PARAM_INT);
				$sth->execute();
				$result = $sth->fetch(PDO::FETCH_ASSOC);
				return $result;

			}

		}

		?>
