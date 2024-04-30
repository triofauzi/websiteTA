<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PaySlip
 * 
 * @property int $id
 * @property int $user_id
 * @property int $payroll_period_id
 * @property string $pay_slip_path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property PayrollPeriod $payroll_period
 * @property User $user
 *
 * @package App\Models
 */
class PaySlip extends Model
{
	protected $table = 'pay_slips';

	protected $casts = [
		'user_id' => 'int',
		'payroll_period_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'payroll_period_id',
		'pay_slip_path'
	];

	public function payroll_period()
	{
		return $this->belongsTo(PayrollPeriod::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
