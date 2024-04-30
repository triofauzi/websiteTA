<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Biodatum
 * 
 * @property int $id
 * @property int $user_id
 * @property string|null $identity_number
 * @property string|null $salutation
 * @property string|null $first_name
 * @property string|null $middle_name
 * @property string|null $last_name
 * @property string|null $gender
 * @property string|null $phone_number
 * @property Carbon|null $date_of_birth
 * @property string|null $place_of_birth
 * @property string|null $personal_email
 * @property string|null $address
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Biodata extends Model
{
	protected $table = 'biodata';

	protected $casts = [
		'user_id' => 'int',
		'date_of_birth' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'identity_number',
		'salutation',
		'first_name',
		'middle_name',
		'last_name',
		'gender',
		'phone_number',
		'date_of_birth',
		'place_of_birth',
		'personal_email',
		'address'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function users()
	{
		return $this->hasMany(User::class, 'biodata_id');
	}
}
