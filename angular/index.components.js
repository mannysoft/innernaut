import {DaysComponent} from './app/components/days/days.component';
import {ActivityPageCwComponent} from './app/components/activity-page-cw/activity-page-cw.component';
import {Day8CwComponent} from './app/components/day8-cw/day8-cw.component';
import {Day7CwComponent} from './app/components/day7-cw/day7-cw.component';
import {Day6CwComponent} from './app/components/day6-cw/day6-cw.component';
import {Day5CwComponent} from './app/components/day5-cw/day5-cw.component';
import {Day4CwComponent} from './app/components/day4-cw/day4-cw.component';
import {Day3CwComponent} from './app/components/day3-cw/day3-cw.component';
import {Day2CwComponent} from './app/components/day2-cw/day2-cw.component';
import {Day1CwComponent} from './app/components/day1-cw/day1-cw.component';
import {Day0CwComponent} from './app/components/day0-cw/day0-cw.component';


// Manny Isles
// Components for activities
import {StartPageMiComponent} from './app/components/start-page-mi/start-page-mi.component';
import {ActivityPageMiComponent} from './app/components/activity-page-mi/activity-page-mi.component';
import {Dayoff0Component} from './app/components/dayoff0/dayoff0.component';
import {Day0MiComponent} from './app/components/day0-mi/day0-mi.component';
import {EvaluateFormMIComponent} from './app/components/evaluate-form-mi/evaluate-form-mi.component';
import {ListElementsMIComponent} from './app/components/list-elements-mi/list-elements-mi.component';
// Manny Isles end


import {StartPageCwComponent} from './app/components/start-page-cw/start-page-cw.component';
import {QuestionCWComponent} from './app/components/question-CW/question-CW.component';
import {ListElementsCWComponent} from './app/components/list-elements-CW/list-elements-CW.component';
import {ListEvluateCWComponent} from './app/components/list-evluate-CW/list-evluate-CW.component';
import {EvluateFormCWComponent} from './app/components/evluate-form-CW/evluate-form-CW.component';
import {CreateGroupCWComponent} from './app/components/create-group-CW/create-group-CW.component';
import {CreateElementCWComponent} from './app/components/create-element-CW/create-element-CW.component';
import {NavFormCWComponent} from './app/components/nav-form-CW/nav-form-CW.component';
import {ActivityFormCWComponent} from './app/components/Activity-form-CW/Activity-form-CW.component';
import {CreatePostFormComponent} from './app/components/create_post_form/create_post_form.component';
import {AppHeaderComponent} from './app/components/app-header/app-header.component';
import {AppViewComponent} from './app/components/app-view/app-view.component';
import {AppShellComponent} from './app/components/app-shell/app-shell.component';
import {ResetPasswordComponent} from './app/components/reset-password/reset-password.component';
import {ForgotPasswordComponent} from './app/components/forgot-password/forgot-password.component';
import {LoginFormComponent} from './app/components/login-form/login-form.component';
import {RegisterFormComponent} from './app/components/register-form/register-form.component';


angular.module('app.components')
	.component('days', DaysComponent)
	.component('dayoff0', Dayoff0Component)
	.component('activityPageCw', ActivityPageCwComponent)
	.component('day8Cw', Day8CwComponent)
	.component('day7Cw', Day7CwComponent)
	.component('day6Cw', Day6CwComponent)
	.component('day5Cw', Day5CwComponent)
	.component('day4Cw', Day4CwComponent)
	.component('day3Cw', Day3CwComponent)
	.component('day2Cw', Day2CwComponent)
	.component('day1Cw', Day1CwComponent)
	.component('day0Cw', Day0CwComponent)

	.component('startPageMi', StartPageMiComponent)
	.component('activityPageMi', ActivityPageMiComponent) // Manny Isles
	.component('day0Mi', Day0MiComponent)
	.component('listElementsMi', ListElementsMIComponent)
	.component('evaluateFormMi', EvaluateFormMIComponent) // Manny Isles

	.component('startPageCw', StartPageCwComponent)
	.component('questionCW', QuestionCWComponent)
	.component('listElementsCW', ListElementsCWComponent)
	.component('listEvluateCW', ListEvluateCWComponent)
	.component('evluateFormCW', EvluateFormCWComponent)
	.component('createGroupCW', CreateGroupCWComponent)
	.component('createElementCW', CreateElementCWComponent)
	.component('navFormCW', NavFormCWComponent)
	.component('activityFormCW', ActivityFormCWComponent)
	.component('createPostForm', CreatePostFormComponent)
	.component('appHeader', AppHeaderComponent)
	.component('appView', AppViewComponent)
	.component('appShell', AppShellComponent)
	.component('resetPassword', ResetPasswordComponent)
	.component('forgotPassword', ForgotPasswordComponent)
	.component('loginForm', LoginFormComponent)
	.component('registerForm', RegisterFormComponent);