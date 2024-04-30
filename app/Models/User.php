<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int|null $biodata_id
 * @property int|null $employee_payroll_id
 * @property int|null $job_position_id
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Biodatum|null $biodatum
 * @property EmployeePayroll|null $employee_payroll
 * @property JobPosition|null $job_position
 * @property Collection|Biodatum[] $biodata
 * @property Collection|CareerTransitionHistory[] $career_transition_histories
 * @property Collection|EmployeeBank[] $employee_banks
 * @property Collection|EmployeePayroll[] $employee_payrolls
 * @property Collection|LeaveRequest[] $leave_requests
 * @property Collection|PaySlip[] $pay_slips
 * @property Collection|RetirementRequest[] $retirement_requests
 *
 * @package App\Models
 */

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable;

	protected $table = 'users';

	protected $casts = [
		'biodata_id' => 'int',
		'employee_payroll_id' => 'int',
		'job_position_id' => 'int',
		'email_verified_at' => 'datetime'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'biodata_id',
		'employee_payroll_id',
		'job_position_id',
		'email_verified_at',
		'password',
		'remember_token'
	];

	public function biodatum()
	{
		return $this->belongsTo(Biodata::class, 'biodata_id');
	}

	public function employee_payroll()
	{
		return $this->belongsTo(EmployeePayroll::class);
	}

	public function job_position()
	{
		return $this->belongsTo(JobPosition::class);
	}

	public function biodata()
	{
		return $this->hasMany(Biodata::class);
	}

	public function career_transition_histories()
	{
		return $this->hasMany(CareerTransitionHistory::class);
	}

	public function employee_banks()
	{
		return $this->hasMany(EmployeeBank::class);
	}

	public function employee_payrolls()
	{
		return $this->hasMany(EmployeePayroll::class);
	}

	public function leave_requests()
	{
		return $this->hasMany(LeaveRequest::class);
	}

	public function pay_slips()
	{
		return $this->hasMany(PaySlip::class);
	}
	
	public function retirement_requests()
	{
		return $this->hasMany(RetirementRequest::class);
	}

	public function hasNoParentJobPosition()
	{
		$employeeParentJobPosition = JobPosition::where('id', $this->job_position?->parent_id)->first();

		if ($employeeParentJobPosition == NULL) {
			return true;
		}

		return false;
	}

	public function employeeFullName(): string
	{
		return $this->biodatum?->first_name . ' ' . $this->biodatum?->middle_name . ' ' . $this->biodatum?->last_name;
	}
}
