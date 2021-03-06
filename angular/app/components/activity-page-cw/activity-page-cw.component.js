class ActivityPageCwController{
    constructor(API,$stateParams, $mdSidenav){
        'ngInject';
        this.API =API;
        this.$state = $stateParams;
        this.$mdSidenav= $mdSidenav;
        this.id='';
        this.gid='';
        this.gurl='';
        this.activityTitle='';
        this.activityText='';

    }

    $onInit(){
        this.id=this.$state.id;
        this.gid=this.id % 9;
        this.gurl="img/act/" + this.gid+".png";
        this.getActivity();
    }

    getActivity(){
        this.API.all('activity/' + this.gid).get('')
            .then((response) => {
            this.activityTitle = response.data.activity.name;
            this.activityText = response.data.activity.description;
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

export const ActivityPageCwComponent = {
    templateUrl: './views/app/components/activity-page-cw/activity-page-cw.component.html',
    controller: ActivityPageCwController,
    controllerAs: 'vm',
    bindings: {}
}
