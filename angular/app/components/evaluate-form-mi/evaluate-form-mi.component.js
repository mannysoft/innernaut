class EvaluateFormMIController{
    constructor(API, $stateParams, ToastService){
        'ngInject';

        this.API = API;
        this.$state = $stateParams;
        this.ToastService = ToastService;
        this.firstquestions = "Question need to encode";
        this.secondquestions = "";
    }

    $onInit(){
        this.id = this.$state.id;

        this.items = {
            1 : "Motivation",
            2 : "Control",
            3 : "Relations",
            4 : "Emotions",
            5 : "Insight",
            6 : "Functions",
            7 : "Adaptation",
            8 : "Change",
            9 : "Balance"
        };


        this.answer = 0;
        this.t3answer1 = 0;
        this.t3answer2 = 0;
        this.t3answer3 = 0;
        this.t3answer4 = 0;
        this.t3answer5 = 0;
        this.t3answer6 = 0;
        this.t3answer7 = 0;
        this.t3answer8 = 0;
        this.t3answer9 = 0;

        this.t3answer1a = 0;
        this.t3answer2a = 0;
        this.t3answer3a = 0;
        this.t3answer4a = 0;
        this.t3answer5a = 0;
        this.t3answer6a = 0;
        this.t3answer7a = 0;
        this.t3answer8a = 0;
        this.t3answer9a = 0;

        this.t3answer1b = 0;
        this.t3answer2b = 0;
        this.t3answer3b = 0;
        this.t3answer4b = 0;
        this.t3answer5b = 0;
        this.t3answer6b = 0;
        this.t3answer7b = 0;
        this.t3answer8b = 0;
        this.t3answer9b = 0;

        this.getQuestion();
    }

    getQuestion(){
        this.API.all('question/' + this.id).get('')
            .then((response) => {
            this.firstquestions = response.data.questions.problem;
            // this.id = this.$state.id;
            //this.id = response.data.questions.id;
    });
    }
    singleQuestion(){
        var data = {
            id: this.id,
            giver: this.giver,
            taker: this.taker,
            day: this.day,
            answer: this.answer
        };

        // console.log("post");

        this.API.all('activities/'+ this.id + '/evaluate').post(data).then((response) => {
            this.ToastService.show('Evaluate added successfully');
        });
        // this.id = this.id+1;
        //this.getQuestion();
    }

    submit33Question(){
        var data = {
            id: this.id,
            day: this.day,
            q33: true,
            answer1: this.t3answer1,
            answer2: this.t3answer2,
            answer3: this.t3answer3,
            answer4: this.t3answer4,
            answer5: this.t3answer5,
            answer6: this.t3answer6,
            answer7: this.t3answer7,
            answer8: this.t3answer8,
            answer9: this.t3answer9,
        };

        this.API.all('activities/'+ this.id + '/evaluate').post(data).then((response) => {
            this.ToastService.show('Evaluate added successfully');
        });
        // this.id = this.id + 1;
        // this.getQuestion();
    }

    submit332Question(){
        var data = {
            id: this.id,
            giver: this.giver,
            taker: this.taker,
            day: this.day,
            q332: true,
            answer1a: this.t3answer1a,
            answer2a: this.t3answer2a,
            answer3a: this.t3answer3a,
            answer4a: this.t3answer4a,
            answer5a: this.t3answer5a,
            answer6a: this.t3answer6a,
            answer7a: this.t3answer7a,
            answer8a: this.t3answer8a,
            answer9a: this.t3answer9a,

            answer1b: this.t3answer1b,
            answer2b: this.t3answer2b,
            answer3b: this.t3answer3b,
            answer4b: this.t3answer4b,
            answer5b: this.t3answer5b,
            answer6b: this.t3answer6b,
            answer7b: this.t3answer7b,
            answer8b: this.t3answer8b,
            answer9b: this.t3answer9b,
        };

        this.API.all('activities/'+ this.id + '/evaluate').post(data).then((response) => {
            this.ToastService.show('Evaluate added successfully');
        });
        // this.id = this.id + 1;
        // this.getQuestion();
    }

    groupScan(){
        var data = {
            id: this.id,
            giver: this.giver,
            taker: this.taker,
            day: this.day,
            groupscan: true,
        };

        // this.API.all('evaluate').post(data).then((response) => {
        //     this.ToastService.show('Evaluate added successfully');
        // });
        // this.id = this.id + 1;
        // this.getQuestion();
    }

    three(id){
        this.API.all('groupquestion/'+id).get('')
            .then((response) => {
            this.secondquestions = response.data.groupquestion.problem;
            });
    }
}

export const EvaluateFormMIComponent = {
    templateUrl: './views/app/components/evaluate-form-mi/evaluate-form-mi.component.html',
    controller: EvaluateFormMIController,
    controllerAs: 'vm',
    bindings: {}
}
