<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployeeBank
 * 
 * @property int $id
 * @property string $account_name
 * @property string $account_number
 * @property string $currency
 * @property string $bank_name
 * @property string $bank_branch
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class EmployeeBank extends Model
{
	protected $table = 'employee_bank';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'account_name',
		'account_number',
		'currency',
		'bank_name',
		'bank_branch',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
