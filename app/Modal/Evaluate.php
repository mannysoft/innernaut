<?php
namespace App\Modal;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;


class Evaluate extends Model
{
    protected $table = 'evaluates';

    protected $fillable = [
        'group_id',
        'give_user_id',
        'take_user_id',
        'day',
        'activity_id',
        'question_id',
        'groupquestion_id',
        'measure',
        'answer',
        'group_user_id',
        'letter',
    ];

    public function users()
    {
        return $this->belongsTo('App\Modal\User');
    }
    public function themes()
    {
        return $this->belongsTo('App\Modal\Theme');
    }

    public function questions()
    {
        return $this->belongsTo('App\Modal\Question');
    }
}
