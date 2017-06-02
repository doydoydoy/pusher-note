<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use SoftDeletes;

class Notes extends Model
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
	 * Fields that are mass assignable
	 *
	 * @var array
	 */
	protected $fillable = ['content', 'user_id'];

	public function user() {
		$this->belongsTo(User::class);
	}
}
