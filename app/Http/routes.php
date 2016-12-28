<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('graph', function() {
    # This script can draw different charts depending on the chartIndex
    $chartIndex = (int)(request("img"));

    # The data for the pie chart
    $data = array(25, 18, 15, 12, 8, 30, 35);

    # The labels for the pie chart
    $labels = array("Labor", "Licenses", "Taxes", "Legal", "Insurance", "Facilities", "Production");

    # Create a PieChart object of size 280 x 240 pixels
    $c = new PieChart(280, 240);

    # Set the center of the pie at (140, 130) and the radius to 80 pixels
    $c->setPieSize(140, 130, 80);

    # Add a title to the pie to show the start angle and direction
    if ($chartIndex == 0) {
        $c->addTitle("Start Angle = 0 degrees\nDirection = Clockwise");
    } else {
        $c->addTitle("Start Angle = 90 degrees\nDirection = AntiClockwise");
        $c->setStartAngle(90, false);
    }

    # Draw the pie in 3D
    $c->set3D();

    # Set the pie data and the pie labels
    $c->setData($data, $labels);

    # Explode the 1st sector (index = 0)
    $c->setExplode(0);

    # Output the chart
    header("Content-type: image/png");
    print($c->makeChart2(PNG));
});

Route::get('results/{email}', function($email){
    $user = \App\Modal\User::where('email', $email)->first();
    $evaluates = \App\Modal\Evaluate::where('take_user_id', $user->id)->orderBy('created_at', 'desc')->get();

    ?>
    <table border=1>
        <th>ID</th><th>group id</th><th>give user id</th><th>take user id</th><th>day</th><th>activity id</th>
        <th>question id</th><th>group question id</th><th>answer</th><th>created at</th>
    <?php
    foreach ($evaluates as $evaluate) {
        ?>
        <tr>
            <td><?php echo $evaluate->id;?></td>
            <td><?php echo $evaluate->group_id;?></td>
            <td><?php echo $evaluate->give_user_id;?></td>
            <td><?php echo $evaluate->take_user_id;?></td>
            <td><?php echo $evaluate->day;?></td>
            <td><?php echo $evaluate->activity_id;?></td>
            <td><?php echo $evaluate->question_id;?></td>
            <td><?php echo $evaluate->groupquestion_id;?></td>
            <td><?php echo $evaluate->answer;?></td>
            <td><?php echo $evaluate->created_at;?></td>
        </tr>
        <?php
    }

    ?>
    </table>
    <?php
});

Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'AngularController@serveApp');

    Route::get('/unsupported-browser', 'AngularController@unsupported');
});
Route::post('posts', 'PostsController@create');

//public API routes
$api->group(['middleware' => ['api']], function ($api) {

    // Authentication Routes...
    $api->post('auth/login', 'Auth\AuthController@login');
    $api->post('auth/register', 'Auth\AuthController@register');
    $api->post('posts', 'PostsController@create');
    // Password Reset Routes...
    $api->post('auth/password/email', 'Auth\PasswordResetController@sendResetLinkEmail');
    $api->get('auth/password/verify', 'Auth\PasswordResetController@verify');
    $api->post('auth/password/reset', 'Auth\PasswordResetController@reset');

    // Elements
    $api->post('create-element', 'CWElementController@create');
    $api->post('evaluate', 'CWEvaluateController@create');
    $api->get('list-elements', 'CWElementController@get');
    $api->get('list-evaluates', 'CWEvaluateController@get');
    
    //Groups
    $api->post('groups', 'CWGroupsController@create');
    $api->get('list-groups', 'CWGroupsController@get');
    $api->post('delete-group', 'CWGroupsController@delete');
    //Activities
    $api->post('activities', 'CWActivitiesController@create');
    $api->get('list-activities', 'CWActivitiesController@get');
    $api->post('delete-activity', 'CWActivitiesController@delete');
    $api->get('activity/{id}', 'CWActivitiesController@getId');
    //Questions
    $api->post('questions', 'CWQuestionController@create');
    $api->get('list-questions', 'CWQuestionController@get');
    $api->post('delete-question', 'CWQuestionController@delete');
    $api->get('question/{id}', 'CWQuestionController@getId');

    //GroupQuestion
    $api->get('groupquestion/{id}', 'CWGroupQuestionController@getId');

});

//protected API routes with JWT (must be logged in)
$api->group(['middleware' => ['api', 'api.auth']], function ($api) {
    // Posts
   // $api->post('posts', 'PostsController@create');

    // Manny Isles
    // Days
    $api->get('days/{id}/activities', 'MIActivityController@dayActivities');
    $api->get('days/{dayId}/activities/{id}', 'MIActivityController@show');

    // Evaluate
    $api->get('activities/{id}/evaluate', 'MIEvaluateController@create');
    $api->post('activities/{id}/evaluate', 'MIEvaluateController@create');

    // Users
    $api->get('users', 'MIUserController@index');

    // Elements
    $api->get('elements', 'MIElementController@index');
    

});

