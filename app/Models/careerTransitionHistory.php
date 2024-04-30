<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CareerTransitionHistory
 * 
 * @property int $id
 * @property int $user_id
 * @property int $job_position_from_id
 * @property int $job_position_to_id
 * @property string $letter_path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property JobPosition $job_position
 *
 * @package App\Models
 */
class CareerTransitionHistory extends Model
{
	protected $table = 'career_transition_histories';

	protected $casts = [
		'user_id' => 'int',
		'job_position_from_id' => 'int',
		'job_position_to_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'job_position_from_id',
		'job_position_to_id',
		'letter_path'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function job_position_to()
	{
		return $this->belongsTo(JobPosition::class, 'job_position_to_id');
	}
	
	public function job_position_from()
	{
		return $this->belongsTo(JobPosition::class, 'job_position_from_id');
	}
}
