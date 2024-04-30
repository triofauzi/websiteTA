<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JobPosition
 * 
 * @property int $id
 * @property string $name
 * @property int|null $parent_id
 * @property string $department
 * @property string|null $salary_range
 * @property string|null $description
 * @property string $job_type
 * @property string|null $job_place
 * @property string $expected_experience
 * @property string $is_need_candidate
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property JobPosition|null $job_position
 * @property Collection|JobApplication[] $job_applications
 * @property Collection|JobPosition[] $job_positions
 *
 * @package App\Models
 */
class JobPosition extends Model
{
	use HasFactory;

	protected $table = 'job_positions';

	protected $casts = [
		'parent_id' => 'int'
	];

	protected $fillable = [
		'name',
		'parent_id',
		'department',
		'salary_range',
		'description',
		'job_type',
		'job_place',
		'expected_experience',
		'is_need_candidate'
	];

	public function parent_position()
	{
		return $this->belongsTo(JobPosition::class, 'parent_id');
	}

	public function child_positions()
	{
		return $this->hasMany(JobPosition::class, 'parent_id');
	}

	public function job_applications()
	{
		return $this->hasMany(JobApplication::class);
	}

	public function job_positions()
	{
		return $this->hasMany(JobPosition::class, 'parent_id');
	}
}
