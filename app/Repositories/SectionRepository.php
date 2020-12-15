<?php 
namespace App\Repositories;

use App\Models\SectionModel;
/**
 * 
 */
class SectionRepository
{
	
	function __construct()
	{
		# code...
	}

	public function getAll()
	{
		$section = SectionModel::query()
			->with('task')
			->orderBy('created_at', 'desc')
			->get();
		return $section;
	}

	public function getById($id, $filter_task = null)
	{
		$section = SectionModel::query()
			->with([
				'task' => function($query) use ($filter_task){
					if (!empty($filter_task)) {
	                    $query->where('task_state', $filter_task);
					}
                }, 
                'task.section'
            ])
			->where('id', $id)
			->first();
		return $section;
	}

	public function create($data = [])
	{
		$section = SectionModel::create($data);
		return $section;
	}

	public function update($id, $data = [])
	{
		$section = $this->getById($id);
		return $section->update($data);
	}

	public function delete($id)
	{
		return SectionModel::where('id', $id)->delete();
	}
}