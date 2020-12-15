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

	public function getById($id)
	{
		$section = SectionModel::query()
			->with('task')
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