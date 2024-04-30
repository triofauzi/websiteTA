<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployeePayroll
 * 
 * @property int $id
 * @property string|null $salary
 * @property int|null $employee_bank_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property EmployeeBank|null $employee_bank
 * @property User $user
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class EmployeePayroll extends Model
{
	protected $table = 'employee_payroll';

	protected $casts = [
		'employee_bank_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'salary',
		'employee_bank_id',
		'user_id'
	];

	public function employee_bank()
	{
		return $this->belongsTo(EmployeeBank::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
