'use strict';

angular.module('todolistApp').factory('Task', function ($resource) {
    return $resource('http://todoapi.local.com/api/tasks/:taskId', {taskId: '@id'},
    {
        'update': {method: 'PUT'}
    }
    );
}).factory('Category', function ($resource) {
    return $resource('http://todoapi.local.com/api/categories/:catId', {catId: '@id'},
    {
        'update': {method: 'PUT'}
    }
    );
});