(function () {
    'use strict';

    angular
        .module('App')
        .factory('CoachingRecordService', CoachingRecordService);

    CoachingRecordService.$inject = ['$http'];

    function CoachingRecordService($http) {
        return {
            Read: Read,
        }

        function Read() {
            return $http({
                method: 'POST',
                url: '../Json/CoachingRecord.php',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            });
        }
    }
})();