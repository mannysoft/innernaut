export function RoutesConfig($stateProvider, $urlRouterProvider) {
	'ngInject';

	let getView = (viewName) => {
		return `./views/app/pages/${viewName}/${viewName}.page.html`;
	};

	$urlRouterProvider.otherwise('/');

	$stateProvider
		.state('app', {
			abstract: true,
            data: {},//{auth: true} would require JWT auth
			views: {
				header: {
					templateUrl: getView('header')
				},
				footer: {
					templateUrl: getView('footer')
				},
				main: {}
			}
		})
		.state('app.landing', {
            url: '/',
            views: {
                'main@': {
                    // templateUrl: getView('start-page-cw')
                    templateUrl: getView('start-page-mi') // manny
                }
            }
        })
        .state('app.login', {
			url: '/login',
			views: {
				'main@': {
					templateUrl: getView('login')
				}
			}
		})
        .state('app.register', {
            url: '/register',
            views: {
                'main@': {
                    templateUrl: getView('register')
                }
            }
        })
        .state('app.forgot_password', {
            url: '/forgot-password',
            views: {
                'main@': {
                    templateUrl: getView('forgot-password')
                }
            }
        })
        .state('app.reset_password', {
            url: '/reset-password/:email/:token',
            views: {
                'main@': {
                    templateUrl: getView('reset-password')
                }
            }
        })

        .state('app.create_element', {
            url: '/create-element',
            views: {
                'main@': {
                    templateUrl: getView('create-element-CW')
                }
            }
        })
        .state('app.list_elements', {
            url: '/list-elements',
            views: {
                'main@': {
                    templateUrl: getView('list-elements-CW')
                }
            }
        })
        .state('app.list_evaluates', {
            url: '/list-evaluates',
            views: {
                'main@': {
                    templateUrl: getView('list-evluate-CW')
                }
            }
        })

		.state('app.create_post', {
	        url: '/create-post',
	        views: {
	          'main@': {
	            templateUrl: getView('create_post')
	          }
	        }
	      })
        .state('app.create_activity', {
            url: '/create-activity',
            views: {
                'main@': {
                    templateUrl: getView('nav-form-CW')
                }
            }
        })
        .state('app.evaluate', {
            url: '/evaluate',
            views: {
                'main@': {
                    templateUrl: getView('evaluate-form-CW')
                }
            }
        })
        .state('app.create_group', {
        url: '/create-group',
        views: {
            'main@': {
                templateUrl: getView('create-group-CW')
            }
        }
    })
        // .state('app.activity', {
        //     url: '/activity',
        //     views: {
        //         'main@': {
        //             templateUrl: getView('Activity-CW')
        //         }
        //     }
        // })
        .state('app.question', {
            url: '/question',
            views: {
                'main@': {
                    templateUrl: getView('question-CW')
                }
            }
        })
        .state('app.day', {
            url: '/day/:id',
            views: {
                'main@': {
                    templateUrl: getView('day0-cw')
                }
            }
        })
        .state('app.day0', {
            url: '/day0',
            views: {
                'main@': {
                    templateUrl: getView('day0-mi')
                }
            }
        })
        
        .state('app.day1', {
            url: '/day1',
            views: {
                'main@': {
                    templateUrl: getView('day1-mi')
                }
            }
        })
        .state('app.day2', {
            url: '/day2',
            views: {
                'main@': {
                    // templateUrl: getView('day2-cw')
                    templateUrl: getView('day2-mi') // manny
                }
            }
        })
        .state('app.day3', {
            url: '/day3',
            views: {
                'main@': {
                    // templateUrl: getView('day3-cw')
                    templateUrl: getView('day3-mi') // manny
                }
            }
        })
        .state('app.day4', {
            url: '/day4',
            views: {
                'main@': {
                    // templateUrl: getView('day4-cw')
                    templateUrl: getView('day4-mi') // manny
                }
            }
        })
        .state('app.day5', {
            url: '/day5',
            views: {
                'main@': {
                    // templateUrl: getView('day5-cw')
                    templateUrl: getView('day5-mi') // manny
                }
            }
        })
        .state('app.day6', {
            url: '/day6',
            views: {
                'main@': {
                    // templateUrl: getView('day6-cw')
                    templateUrl: getView('day6-mi') // manny
                }
            }
        })
        .state('app.day7', {
            url: '/day7',
            views: {
                'main@': {
                    // templateUrl: getView('day7-cw')
                    templateUrl: getView('day7-mi') // manny
                }
            }
        })
        .state('app.day8', {
            url: '/day8',
            views: {
                'main@': {
                    // templateUrl: getView('day8-cw')
                    templateUrl: getView('day8-mi') // manny
                }
            }
        })
        .state('app.dayoff0', {
            url: '/dayoff0',
            views: {
                'main@': {
                    templateUrl: getView('dayoff0') // manny
                }
            }
        })
        .state('app.activity', {
            url: '/activity/:id',
            params: { id : null},
            views: {
                'main@': {
                    // templateUrl: getView('activity-page-cw')
                    templateUrl: getView('activity-page-mi') // manny
                }
            }
        })
        .state('app.days', {
            url: '/days/:id',
            params: { id : null},
            views: {
                'main@': {
                    templateUrl: getView('days') // manny
                }
            }
        })
        .state('app.activities', {
            url: '/days/:day_id/activities/:id',
            params: { day_id: null, id : null},
            views: {
                'main@': {
                    templateUrl: getView('activity-page-mi') // manny
                }
            }
        })
        .state('app.evaluateactivity', {
            url: '/activities/:id/evaluate',
            params: { id : null},
            views: {
                'main@': {
                    templateUrl: getView('evaluate-form-mi')
                }
            }
        })
        // .state('app.activities', {
        //     url: '/days/:day_id/activities/:id',
        //     params: { day_id: null, id : null},
        //     views: {
        //         'main@': {
        //             templateUrl: getView('activity-page-mi') // manny
        //         }
        //     }
        // })
}
