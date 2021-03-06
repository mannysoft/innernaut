class NoImageCacheController{
    constructor(){
        'ngInject';

        //
    }
}

export function NoImageCacheDirective(){
    return {
        priority: 99,
        link: function(scope, element, attrs) {
          attrs.$observe('noCacheSrc', function(noCacheSrc) {
            noCacheSrc += '?' + (new Date()).getTime();
            attrs.$set('src', noCacheSrc);
          });
        }
      }
}
