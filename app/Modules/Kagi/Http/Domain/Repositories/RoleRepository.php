<?php namespace App\Modules\Kagi\Http\Domain\Repositories;

use App\Modules\Kagi\Http\Domain\Models\Role;

//use File, Auth;

class RoleRepository extends BaseRepository {

	/**
	 * The Role instance.
	 *
	 * @var App\Models\Role
	 */
	protected $role;

	/**
	 * Create a new RoleRepository instance.
	 *
	 * @param  App\Modules\Kagi\Http\Domain\Models\Role $role
	 * @return void
	 */
	public function __construct(
		Role $role
		)
	{
		$this->model = $role;
	}

	/**
	 * Get role collection.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function create()
	{
//		$select = $this->role->all()->lists('title', 'id');
//		$statut = $this->getStatut();

//		return compact('select', 'statut');
//		return compact('select', 'statut');
	}

	/**
	 * Get user collection.
	 *
	 * @param  int  $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit($id)
	{
		$role = $this->getById($id);

//		$select = $this->role->all()->lists('title', 'id');

		return compact('role', 'select');
	}

	/**
	 * Get all models.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function store($input)
	{
//dd($input);
		$this->model = new Role;
		$this->model->create($input);
	}

	/**
	 * Update a role.
	 *
	 * @param  array  $inputs
	 * @param  int    $id
	 * @return void
	 */
	public function update($input, $id)
	{
		$role = $this->getById($id);
		$role->update($input);
	}

}