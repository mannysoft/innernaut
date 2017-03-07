class ListElementsMIController{
    constructor(API, $stateParams, ToastService){
        'ngInject';

        this.API = API;
        this.$state = $stateParams;
        this.ToastService = ToastService;
        this.elements = [];
    }

    $onInit(){
        this.id = this.$state.id;
        this.getElements();
    }

    getElements(){
        //this.API.all('elements').get('')
        this.API.all('activities/'+ this.id +'/analyze').get('')
            .then((response) => {
            this.elements = response.data;
        });
    }
}

export const ListElementsMIComponent = {
    templateUrl: './views/app/components/list-elements-mi/list-elements-mi.component.html',
    controller: ListElementsMIController,
    controllerAs: 'vm',
    bindings: {}
}
