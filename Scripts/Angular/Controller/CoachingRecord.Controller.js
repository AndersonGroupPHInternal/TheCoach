(function () {
    'use strict';

    angular
        .module('App')
        .controller('CoachingRecordController', CoachingRecordController);

    CoachingRecordController.$inject = ['$filter', '$window', 'CoachingRecordService'];

    function CoachingRecordController($filter, $window, CoachingRecordService) {
        var vm = this;

        vm.CoachingRecords = [];

        vm.GoToUpdatePage = GoToUpdatePage;
        vm.Initialise = Initialise;

        function GoToUpdatePage(coachingRecordId) {
            $window.location.href = '../CoachingRecord/Update/' + coachingRecordId;
        }

        function Initialise() {
            Read();
        }

        function Read() {
            CoachingRecordService.Read()
                .then(function (response) {
                    vm.CoachingRecords = response.data;
                })
                .catch(function (data, status) {
                    new PNotify({
                        title: status,
                        text: data,
                        type: 'error',
                        hide: true,
                        addclass: "stack-bottomright"
                    });
                });
        }
    }
})();