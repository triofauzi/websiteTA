<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LeaveRequest
 * 
 * @property int $id
 * @property int $user_id
 * @property string $attachment
 * @property string $reason
 * @property Carbon $leave_date_from
 * @property Carbon $leave_date_to
 * @property string $description
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class LeaveRequest extends Model
{
	const ATTACHMENT_PATH = 'documents/leave-requests';

	protected $table = 'leave_requests';

	protected $casts = [
		'user_id' => 'int',
		'leave_date_from' => 'datetime',
		'leave_date_to' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'attachment',
		'reason',
		'leave_date_from',
		'leave_date_to',
		'description',
		'status'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
