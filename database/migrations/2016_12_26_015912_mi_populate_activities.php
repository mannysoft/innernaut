<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Modal\Activity;

class MiPopulateActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $activities = Activity::all();

        $day = 2;

        for ($i=0; $i < 8 ; $i++) {
            foreach ($activities as $activity) {
                $newActivity = $activity->replicate();
                $newActivity->day = $day;
                $newActivity->save();
            }
            
            $day ++;
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
