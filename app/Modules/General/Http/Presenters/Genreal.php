<?php
namespace App\Modules\General\Http\Presenters;

use Laracasts\Presenter\Presenter;

use DB;

class School extends Presenter {

//dd('loaded');

	/**
	 * Present the name
	 *
	 * @return string
	 */
	public function name()
	{
		return ucwords($this->entity->name);
	}

	/**
	 * Present the $departments
	 *
	 * @return string
	 */
	public function divisionName($division_id)
	{
		$return = '';
		$division = DB::table('divisions')
			->where('id', '=', $division_id)
			->pluck('name');
		return $division;
	}

	/**
	 * List, Trim: sites
	 *
	 * @return string
	 */
	public function sites()
	{
		$return = '';
		$sites = $this->entity->sites;
//dd($sites);
		if (empty($sites))
		{
			$return = trans('kotoba::general.none');
		} else {
			foreach ($sites as $site)
			{
//				$return .= $site->present()->name() . ',&nbsp;';
				$return .= $site->name . ',<br>';
			}
		}
		return trim($return, ',<br>');
	}



	/**
	 * Present the active field
	 *
	 * @return string
	 */
	public function active()
	{
		return $this->entity->active ? trans('lingos::general.yes') : trans('lingos::general.no');
	}

	/**
	 * Present the profiles
	 *
	 * @return string
	 */
	public function profiles()
	{
		$return   = '';
		$profiles = $this->entity->profiles;
//dd($profiles);

		if (empty($profiles)) {
			$return = trans('lingos::general.none');
		} else {
			foreach ($profiles as $profile) {
//				$return .= $site->present()->name() . ',&nbsp;';
				$return .= $profile->first_name . ',<br>';
			}
		}
	}



	/**
	 * Uppercase: first_name
	 *
	 * @return string
	 */
	public function first_name()
	{
		return ucwords($this->entity->first_name);
	}


	/**
	 * Uppercase: last_name
	 *
	 * @return string
	 */
	public function last_name()
	{
		return ucwords($this->entity->last_name);
	}


	/**
	 * Present<> email
	 *
	 * @return string
	 */
	public function email()
	{
		return $this->entity->email;
	}








	/**
	 * Present the sites
	 *
	 * @return string
	 */
	public function siteName()
	{
		$return = '';
		$sites = $this->entity->sites;
//dd($sites);

		if (empty($sites))
		{
			$return = trans('kotoba::general.none');
		} else {
			foreach ($sites as $site)
			{
//				$return .= $site->present()->name() . ',&nbsp;';
				$return .= $site->name . ',<br>';
			}
		}

		return trim($return, ',<br>');
	}


	/**
	 * Present the $departments
	 *
	 * @return string
	 */
	public function departments()
	{
		$return = '';
		$departments = $this->entity->departments;
//dd($departments);
		if (empty($departments))
		{
			$return = trans('lingos::general.none');
		} else {
			foreach ($departments as $department)
			{
//			$return .= $department->present()->name() . ',&nbsp;';
			$return .= $department->name . ',&nbsp;';
			}
		}

		return trim($return, ',&nbsp;');
	}


	/**
	 * Present the grades
	 *
	 * @return string
	 */
	public function grades()
	{
		$return = '';
		$grades = $this->entity->grades;
//dd($grades);
		if (empty($grades))
		{
			$return = trans('lingos::general.none');
		} else {
			foreach ($grades as $grade)
			{
//			$return .= $grade->present()->name() . ',&nbsp;';
			$return .= $grade->name . ',&nbsp;';
			}
		}

		return trim($return, ',&nbsp;');
	}


	/**
	 * Present the subjects
	 *
	 * @return string
	 */
	public function subjects()
	{
		$return = '';
		$subjects = $this->entity->subjects;
//dd($subjects);
		if (empty($subjects))
		{
			$return = trans('lingos::general.none');
		} else {
			foreach ($subjects as $subject)
			{
//			$return .= $subject->present()->name() . ',&nbsp;';
			$return .= $subject->name . ',&nbsp;';
			}
		}

		return trim($return, ',&nbsp;');
	}

	/**
	 * Present the sites
	 *
	 * @return string
	 */
	public function sitesShow()
	{
		$return = '';
		$sites = $this->entity->sites;
//dd($sites);

		if (empty($sites))
		{
			$return = trans('kotoba::general.none');
		} else {
			foreach ($sites as $site)
			{
//				$return .= $site->present()->name() . ',&nbsp;';
				$return .= $site->name . ',&nbsp;';
			}
		}

		return trim($return, ',&nbsp;');
	}


	/**
	 * Present the jobtitles
	 *
	 * @return string
	 */
	public function jobtitles($id)
	{
/*
		$return = '';
		$jobtitles = $this->entity->job_titles;
//dd($positions);
		if (empty($jobtitles))
		{
			$return = trans('lingos::general.none');
		} else {
			foreach ($jobtitles as $jobtitle)
			{
//			$return .= $position->present()->name() . ',&nbsp;';
			$return .= $jobtitle->name . ',&nbsp;';
			}
		}
*/

		$jobtitle = DB::table('job_titles')
			->where('id', '=', $id)
			->pluck('name');
		return $jobtitle;

//		return trim($return, ',&nbsp;');
	}


	/**
	 * Present the jobtitles
	 *
	 * @return string
	 */
	public function getSupervisior($id)
	{
		$jobtitle = DB::table('profiles')
			->where('id', '=', $id)
			->pluck('first_name', 'Last Name');
		return $jobtitle;
	}



	/**
	 * Present the positions
	 *
	 * @return string
	 */
	public function positions($id)
	{
/*
		$return = '';
		$positions = $this->entity->positions;
//dd($positions);
		if (empty($positions))
		{
			$return = trans('lingos::general.none');
		} else {
			foreach ($positions as $position)
			{
//			$return .= $position->present()->name() . ',&nbsp;';
			$return .= $position->name . ',&nbsp;';
			}
		}
*/


		$position = DB::table('positions')
			->where('id', '=', $id)
			->pluck('name');
		return $position;

//		return trim($return, ',&nbsp;');
	}

	/**
	 * return Checked: departments
	 *
	 * @return string
	 */
	public function checkBoxDepartments($id)
	{
		$departments = $this->entity->departments;
		$departments->toArray();
		$checkBoxValue = '';
		foreach ($departments as $department)
		{
			if ($department['id'] === $id) {
				$checkBoxValue = ' ' . 'checked';
				return $checkBoxValue;
				break;
			}
		}
		return $checkBoxValue;
	}


	/**
	 * return Checked: grades
	 *
	 * @return string
	 */
	public function checkBoxGrades($id)
	{
		$grades = $this->entity->grades;
		$grades->toArray();
		$checkBoxValue = '';
		foreach ($grades as $grade)
		{
			if ($grade['id'] === $id) {
				$checkBoxValue = ' ' . 'checked';
				return $checkBoxValue;
				break;
			}
		}
		return $checkBoxValue;
	}


	/**
	 * return Checked: subjects
	 *
	 * @return string
	 */
	public function checkBoxSubjects($id)
	{
		$subjects = $this->entity->subjects;
		$subjects->toArray();
		$checkBoxValue = '';
		foreach ($subjects as $subject)
		{
			if ($subject['id'] === $id) {
				$checkBoxValue = ' ' . 'checked';
				return $checkBoxValue;
				break;
			}
		}
		return $checkBoxValue;
	}


	/**
	 * return Checked: positions
	 *
	 * @return string
	 */
	public function checkBoxPositions($id)
	{
		$positions = $this->entity->positions;
		$positions->toArray();
		$checkBoxValue = '';
		foreach ($positions as $position)
		{
			if ($position['id'] === $id) {
				$checkBoxValue = ' ' . 'checked';
				return $checkBoxValue;
				break;
			}
		}
		return $checkBoxValue;
	}


	/**
	 * return Checked: sites
	 *
	 * @return string
	 */
	public function checkBoxSites($id)
	{
		$sites = $this->entity->sites;
		$sites->toArray();
		$checkBoxValue = '';
		foreach ($sites as $site)
		{
			if ($site['id'] === $id) {
				$checkBoxValue = ' ' . 'checked';
				return $checkBoxValue;
				break;
			}
		}
		return $checkBoxValue;
	}


	/**
	 * return Selected: departments
	 *
	 * @return string
	 */
	public function selectedDepartments($id)
	{
		$departments = $this->entity->departments;
		$departments->toArray();
		$selectOption = '';
		foreach ($departments as $department)
		{
			if ($department['id'] === $id) {
				$selectOption = ' ' . 'selected';
				return $selectOption;
				break;
			}
		}
		return $selectOption;
	}


	/**
	 * return Selected: jobTitles
	 *
	 * @return string
	 */
	public function selectedJobTitles($id)
	{
		$jobTitles = $this->entity->jobtitles;
		$jobTitles->toArray();
		$selectOption = '';
		foreach ($jobTitles as $jobTitle)
		{
			if ($jobTitle['id'] === $id) {
				$selectOption = ' ' . 'selected';
				return $selectOption;
				break;
			}
		}
		return $selectOption;
	}


	/**
	 * return Selected: grades
	 *
	 * @return string
	 */
	public function selectedGrades($id)
	{
		$grades = $this->entity->grades;
		$grades->toArray();
		$selectOption = '';
		foreach ($grades as $grade)
		{
			if ($grade['id'] === $id) {
				$selectOption = ' ' . 'selected';
				return $selectOption;
				break;
			}
		}
		return $selectOption;
	}


	/**
	 * return Selected: subjects
	 *
	 * @return string
	 */
	public function selectedSubjects($id)
	{
		$subjects = $this->entity->subjects;
		$subjects->toArray();
		$selectOption = '';
		foreach ($subjects as $subject)
		{
			if ($subject['id'] === $id) {
				$selectOption = ' ' . 'selected';
				return $selectOption;
				break;
			}
		}
		return $selectOption;
	}



	/**
	 * return Selected: positions
	 *
	 * @return string
	 */
	public function selectedPositions($id)
	{
		$positions = $this->entity->positions;
		$positions->toArray();
		$selectOption = '';
		foreach ($positions as $position)
		{
			if ($position['id'] === $id) {
				$selectOption = ' ' . 'selected';
				return $selectOption;
				break;
			}
		}
		return $selectOption;
	}


	/**
	 * return Selected: sites
	 *
	 * @return string
	 */
	public function selectedSites($id)
	{
		$sites = $this->entity->sites;
		$sites->toArray();
		$selectOption = '';
		foreach ($sites as $site)
		{
			if ($site['id'] === $id) {
				$selectOption = ' ' . 'selected';
				return $selectOption;
				break;
			}
		}
		return $selectOption;
	}


	/**
	 * YES/NO: isSupervisior
	 *
	 * @return string
	 */
	public function isSupervisior()
	{
		return $this->entity->isSupervisior ? trans('kotoba::general.yes') : trans('kotoba::general.no');
	}


}
