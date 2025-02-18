<?php

namespace Scandiweb\Database\Managers;

use Scandiweb\Database\Managers\Contracts\DatabaseManager;
use Scandiweb\Database\Grammars\MySQLGrammar;
use App\Models\Model;

class MySQLManager implements DatabaseManager
{
	protected static $instance;

	public function connect(): \PDO
	{
		if (!self::$instance) {
			self::$instance = new \PDO(env('DB_DRIVER') . ':host=' . env('DB_HOST') . ';dbname=' . env('DB_DATABASE'), env('DB_USERNAME'), env('DB_PASSWORD'));
		}

		return self::$instance;
	}

	public function create($data)
	{

		$query = MySQLGrammar::InsertQuery(array_keys($data));

		$stmt = self::$instance->prepare($query);

		for ($i = 1; $i <= count($values = array_values($data)); $i++) {
			$stmt->bindValue($i, $values[$i - 1]);
		}

		return $stmt->execute();
	}

	public function delete($id)
	{
		$query = MySQLGrammar::DeleteQuery();

        $stmt = self::$instance->prepare($query);

        $stmt->bindValue(1, $id);

        return $stmt->execute();
	}
	public function deleteMany(array $ids)
	{
		$query = MySQLGrammar::DeleteManyQuery(count($ids));

		$stmt = self::$instance->prepare($query);

		for ($i = 1; $i <= count($ids); $i++) {
			$stmt->bindValue($i, $ids[$i - 1]);
		}

		return $stmt->execute();
	}

	public function query(string $query, array $values = [])
	{
		$stmt = self::$instance->prepare($query);

		for ($i = 1; $i <= count($values); $i++) {
			$stmt->bindValue($i, $values[$i - 1]);
		}

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
	}

	public function read($columns = '*', $filter = null)
	{
		$query = MySQLGrammar::SelectQuery($columns, $filter);

        $stmt = Self::$instance->prepare($query);

        if ($filter) {
            $stmt->bindValue(1, $filter[2]);
        }

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS, Model::getModel());
	}


}