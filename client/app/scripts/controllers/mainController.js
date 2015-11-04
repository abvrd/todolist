'use strict';

/**
 * @ngdoc function
 * @name todolistApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the todolistApp
 */
angular.module('todolistApp').controller('MainCtrl', function ($scope, $interval, Task, Category) {
    //lodash
    $scope._ = _;

    //live clock
    var tick = function () {
        $scope.clock = Date.now();
    };
    tick();
    $interval(tick, 1000);
    //end live clock

    //tabs element buttons
    $scope.tab = {
        clean: false,
        delete: true
    };
    $scope.toggleTabButton = function () {
        $scope.tab.clean = !$scope.tab.clean;
        $scope.tab.delete = !$scope.tab.delete;
    };

    //today's date
    $scope.date = new Date();

    //model for new task
    $scope.task = {
        label: '',
        description: '',
        categories: []
    };

    //tasks list
    $scope.tasks = Task.query({}, function () {
        _.forEach($scope.tasks, function (value) {
            if (value.done !== undefined && value.done !== '') {
                //old tasks
                value = _.merge(value, {enabled: false, deleted: true, visible: false});
            } else {
                //current tasks
                value = _.merge(value, {enabled: false, deleted: false, visible: true});
            }
        });
    });

    //categories list
    $scope.categories = Category.query();
    //selected categories
    $scope.selected = [];
    //model for description panel
    $scope.description = {
        id: 0,
        text: '',
        date: ''
    };

    //handle the strike effect on checked tasks
    $scope.toggle = function (item, list) {
        var idx = list.indexOf(item.id);
        if (idx > -1) {
            list.splice(idx, 1);
            item.deleted = false;
        } else {
            list.push(item.id);
            item.deleted = true;
        }
    };
    $scope.exists = function (item, list) {
        return list.indexOf(item) > -1;
    };

    //setting and updating desc panel for the selected task
    $scope.desc = function (item, desc) {
        if (desc.id === item.id) {
            if (desc.text !== '') {
                desc.text = '';
                desc.date = '';
            } else {
                desc.text = item.description;
                desc.date = item.date;
            }
        } else {
            desc.id = item.id;
            desc.text = item.description;
            desc.date = item.date;
        }
        //clearing enabled status
        _.forEach($scope.tasks, function (value) {
            if (value.id !== item.id) {
                value.enabled = false;
            }
        });
        item.enabled = !item.enabled;
    };

    //create a new task
    $scope.addTask = function () {
        var task = new Task();
        task.label = $scope.task.label;
        task.description = $scope.task.description;
        //getting a list of categories id
        task.categories = JSON.stringify(_.map($scope.task.categories, 'id'));
        
        if (task.label !== '') {
            task.$save(function (data) {
                task = _.merge(data, {enabled: false, deleted: false, visible: true});
                //update view
                $scope.tasks.push(task);

                //reset form fields
                $scope.task.label = '';
                $scope.task.description = '';
                $scope.task.categories = [];
            });
        }
    };

    //$scope.updateTask = function (task) {
        //task.$update();
    //};

    //$scope.deleteTask = function (task) {
        //task.$delete();
    //};

    $scope.deleteTasks = function () {
        _.forEach($scope.tasks, function (value) {
            if (value.visible === false) {
                value.$delete();
                //emptying done list
                value.visible = undefined;
            }
        });
    };

    //set striked tasks to done list
    $scope.cleanTasks = function () {
        _.forEach($scope.tasks, function (value) {
            if (value.deleted === true && value.visible === true) {
                //reset object
                value.visible = false;
                $scope.toggle(value, $scope.selected);

                var task = value;
                task.done = Date.now();
                task.enabled = undefined;
                task.deleted = undefined;
                task.children = undefined;
                task.$update();
            }
        });
    };
});
