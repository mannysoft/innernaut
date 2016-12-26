class DaysController{
    constructor(API, $stateParams){
        'ngInject';
        this.API = API;
        this.$state = $stateParams;
        this.id = '';
        this.activities = [];
        this.activityTitle = '';
        this.activityText = '';
        this.dayName = '';
    }

    $onInit(){
        this.id = this.$state.id;
        //console.log(this.id)
        this.getActivity();
    }

    getActivity(){
        this.API.all('days/' + this.id + '/activities').get('')
            .then((response) => {
            // this.activityTitle = response.data.activity.name;
            // this.activityText = response.data.activity.description;
            this.activities = response.data.activities;
            this.dayNumber = 'Day ' + this.id;
            this.dayName = response.data.dayName;
        });
    }
}

export const DaysComponent = {
    templateUrl: './views/app/components/days/days.component.html',
    controller: DaysController,
    controllerAs: 'vm',
    bindings: {}
}
