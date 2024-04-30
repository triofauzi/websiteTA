<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PayrollPeriod
 * 
 * @property int $id
 * @property string $period_code
 * @property Carbon $pay_date
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class PayrollPeriod extends Model
{
	protected $table = 'payroll_periods';

	protected $casts = [
		'pay_date' => 'datetime'
	];

	protected $fillable = [
		'period_code',
		'pay_date',
		'description'
	];
}
