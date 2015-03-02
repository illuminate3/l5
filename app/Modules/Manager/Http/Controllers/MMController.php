<?php
namespace App\Modules\Manager\Http\Controllers;

use App\Modules\Manager\Http\Domain\Models\Module;
use App\Modules\Manager\Http\Domain\Repositories\ModuleRepository;

use Illuminate\Http\Request;
use App\Modules\Manager\Http\Requests\ModuleCreateRequest;
use App\Modules\Manager\Http\Requests\ModuleUpdateRequest;
use App\Modules\Manager\Http\Requests\DeleteRequest;

//use Datatable;
use Datatables;
//use Bootstrap;
use Flash;

class MMController extends ManagerController {

	/**
	 * The UserRepository instance.
	 *
	 * @var App\Modules\Kagi\Http\Domain\Repositories\UserRepository
	 */
	protected $modules;

	/**
	 * Create a new UserController instance.
	 *
	 * @param  App\Modules\Kagi\Http\Domain\Repositories\UserRepository $user
	 * @param  App\Modules\Profiles\Http\Domain\Repositories\ProfileRepository $profile
	 * @return void
	 */
	public function __construct(
			ModuleRepository $module
		)
	{
		$this->module = $module;

		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
//dd("loaded");
		return View('manager::modules.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
//dd("create");
//		return view('kagi::users.create', $this->user->create());
		return view('profiles::profiles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  App\requests\UserCreateRequest $request
	 *
	 * @return Response
	 */
	public function store(
		UserCreateRequest $request
		)
	{
dd("store");
		$this->user->store($request->all());

		return redirect('user')->with('ok', trans('back/users.created'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
//dd("show");
		return View('manager::modules.show',  $this->module->show($id));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
//dd("edit");
		return View('manager::modules.edit',  $this->module->edit($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  App\requests\UserUpdateRequest $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		ModuleUpdateRequest $request,
		$id
		)
	{
//dd($request->enabled);

		$this->module->update($request->all(), $id);
		Flash::success( trans('kotoba::module.success.update') );
		return redirect('manager');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(
		DeleteRequest $request,
		$id
		)
	{
		$this->user->destroy($id);

		return redirect('user')->with('ok', trans('back/users.destroyed'));
	}

	/**
	 * Display the roles form
	 *
	 * @return Response
	 */
	public function getRoles()
	{
		$roles = $this->role->all();

		return view('back.users.roles', compact('roles'));
	}

	/**
	 * Update roles
	 *
	 * @param  App\requests\RoleRequest $request
	 * @return Response
	 */
	public function postRoles(RoleRequest $request)
	{
		$this->role->update($request->except('_token'));

		return redirect('user/roles')->with('ok', trans('back/roles.ok'));
	}

	/**
	* Show a list of all the languages posts formatted for Datatables.
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//dd("loaded");
/*
			$table->string('name')->unique()->index();
			$table->string('slug')->unique()->index();
			$table->string('version')->nullable()->index();
			$table->text('description')->nullable();
			$table->boolean('enabled')->nullable()->default('true');
*/
		$modules = Module::select(array('modules.id','modules.name','modules.slug','modules.version','modules.description','modules.enabled','modules.order'))
			->orderBy('modules.name', 'ASC');
//dd($profiles);

		return Datatables::of($modules)

			->add_column(
				'actions',
				'<a href="{{ URL::to(\'admin/manager/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
					<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
				</a>
				<a href="{{ URL::to(\'welcome/\' . $slug . \'/\' ) }}" class="btn btn-info btn-sm" >
					<span class="glyphicon glyphicon-search"></span>  {{ trans("kotoba::button.view") }}
				</a>
				')
/*
				<a href="{{ URL::to(\'admin/users/\' . $id . \'/\' ) }}" class="btn btn-sm btn-danger action_confirm" data-method="delete" title="{{ trans(\'kotoba::general.command.delete\') }}" onclick="">
					<span class="glyphicon glyphicon-trash"></span> {{ trans("kotoba::button.delete") }}
				</a>
*/

				->remove_column('id')

				->make();
	}

}
