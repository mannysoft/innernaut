class ActivityPageMiController{
    constructor(API,$stateParams, $mdSidenav){
        'ngInject';
        this.API =API;
        this.$state = $stateParams;
        this.$mdSidenav= $mdSidenav;
        this.day_id = '';
        this.id='';
        this.gid='';
        this.gurl='';
        this.activityTitle='';
        this.activityText='';

    }

    $onInit(){
        this.activity_id = '';
        this.day_id=this.$state.day_id;
        this.id=this.$state.id;
        this.gurl="img/activity/" + this.id+".png";
        this.getActivity();
    }

    getActivity(){
        this.API.all('days/'+ this.day_id + '/activities/' + this.id).get('')
            .then((response) => {
            this.activity_id = response.data.activities.id;;
            this.activityTitle = response.data.activities.name;
            this.activityText = response.data.activities.description;
            this.gurl = 'img/activity/' + response.data.activities.icon;
        });
    }
    isOpenRight(){
        return this.$mdSidenav('right').isOpen();
    }
    toggleRight(){
        this.$mdSidenav(right)
            .toggle()
    };

}

export const ActivityPageMiComponent = {
    templateUrl: './views/app/components/activity-page-mi/activity-page-mi.component.html',
    controller: ActivityPageMiController,
    controllerAs: 'vm',
    bindings: {}
}
