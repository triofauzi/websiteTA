<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JobApplication
 * 
 * @property int $id
 * @property string $full_name
 * @property string $residence_address
 * @property string $gender
 * @property string $phone_number
 * @property string $email
 * @property Carbon $date_of_birth
 * @property string $place_of_birth
 * @property string $curriculum_vitae
 * @property int $job_position_id
 * @property string $application_status
 * @property string|null $letter_path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property JobPosition $job_position
 *
 * @package App\Models
 */
class JobApplication extends Model
{
	use HasFactory;

	const FILE_PATH = 'files/application/curriculum-vitae';
	
	protected $table = 'job_application';

	protected $casts = [
		'date_of_birth' => 'datetime',
		'job_position_id' => 'int'
	];

	protected $fillable = [
		'full_name',
		'residence_address',
		'gender',
		'phone_number',
		'email',
		'date_of_birth',
		'place_of_birth',
		'curriculum_vitae',
		'job_position_id',
		'application_status',
		'letter_path'
	];

	public function job_position()
	{
		return $this->belongsTo(JobPosition::class);
	}
}
