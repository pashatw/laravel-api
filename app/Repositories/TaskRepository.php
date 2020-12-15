<?php 
namespace App\Repositories;

use App\Models\TaskModel;
/**
 * 
 */
class TaskRepository
{
	
	function __construct()
	{
		# code...
	}

	public function getAll($filter_state = null)
	{
		$task = TaskModel::query();
		
		if (!empty($filter_state)) {
			$task->where('task_state', $filter_state);
		}

		return $task->with('section')
			->orderBy('created_at', 'desc')
			->get();
	}

	public function getManyBySection($section_id)
	{
		$task = TaskModel::query()
			->with('section')
			->where('section_id', $section_id)
			->orderBy('created_at', 'desc')
			->get();
		return $task;
	}

	public function getById($id)
	{
		$task = TaskModel::query()
			->with('section')
			->where('id', $id)
			->first();
		return $task;
	}

	public function create($data = [])
	{
		$task = TaskModel::create($data);
		return $task;
	}

	public function update($id, $data = [])
	{
		$task = $this->getById($id);
		return $task->update($data);
	}

	public function delete($id)
	{
		return TaskModel::where('id', $id)->delete();
	}
}