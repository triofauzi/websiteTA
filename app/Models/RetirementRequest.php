<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RetirementRequest
 * 
 * @property int $id
 * @property int $user_id
 * @property string|null $letter_path
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class RetirementRequest extends Model
{
	const LETTER_PATH = 'files/retirement-requests/';

	protected $table = 'retirement_requests';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'letter_path',
		'status'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
