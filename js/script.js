<script>

  app.controller('filterCtrl', ['$scope', '$http', function($scope,$http) {
    $scope.data =  $http.get("http://localhost/crud/php2json.php")
      .success(function(response) {$scope.data = response;});

  $scope.liveFilter = [
    { 
      name: 'approved', 
      selected: false
    }
  ];
  $scope.deadFilter = [
    { 
      name: 'notApproved', 
      selected: false
    }
  ];
  $scope.USFilter = [
    { 
      name: 'US', 
      selected: false
    }
  ];
  $scope.CAFilter = [
    { 
      name: 'CA', 
      selected: false
    }
  ];  
  $scope.AUSFilter = [
    { 
      name: 'AU', 
      selected: false
    }
  ];
  $scope.UKFilter = [
    { 
      name: 'UK', 
      selected: false
    }
  ];


  // FILTERS LIVE OFFERS 
    $scope.itemFilterLive = function(data) {
      var filters = $scope.liveFilter.filter(function(element, idx, array) {
        return element.selected;
      }) || [];
      
      var matched = true;

      filters.forEach(function(approvedCheck) {
        matched = matched && data.status.indexOf(approvedCheck.name)  >=0;

      })
      return matched;
    };


  // // FILTERS DEAD OFFERS 
    $scope.itemFilterDead = function(data) {
      var filters = $scope.deadFilter.filter(function(element, idx, array) {
        return element.selected;
      }) || [];
      
      var matched6 = true;

      filters.forEach(function(notApprovedCheck) {
        matched6 = matched6 && data.status.indexOf(notApprovedCheck.name)  >=0;

      })
      return matched6;
    };


  // FILTERS US OFFERS

    $scope.itemUSFilter = function(item) {
      var filters = $scope.USFilter.filter(function(element, idx, array) {
        return element.selected;
      }) || [];
      
      var matched2 = true;

      filters.forEach(function(USCheckBox) {
        matched2 = matched2 && item.country.indexOf(USCheckBox.name)  >=0;

      })
      return matched2;
    };


  // FILTERS CA OFFERS

    $scope.itemCAFilter = function(item) {
      var filters = $scope.CAFilter.filter(function(element, idx, array) {
        return element.selected;
      }) || [];
      
      var matched3 = true;

      filters.forEach(function(CACheckBox) {
        matched3 = matched3 && item.country.indexOf(CACheckBox.name)  >=0;

      })
      return matched3;
    };

  // FILTERS AUS OFFERS

    $scope.itemAUSFilter = function(item) {
      var filters = $scope.AUSFilter.filter(function(element, idx, array) {
        return element.selected;
      }) || [];
      
      var matched4 = true;

      filters.forEach(function(AUSCheckBox) {
        matched4 = matched4 && item.country.indexOf(AUSCheckBox.name)  >=0;

      })
      return matched4;
    };

  // FILTERS UK OFFERS

    $scope.itemUKFilter = function(item) {
      var filters = $scope.UKFilter.filter(function(element, idx, array) {
        return element.selected;
      }) || [];
      
      var matched5 = true;

      filters.forEach(function(UKCheckBox) {
        matched5 = matched5 && item.country.indexOf(UKCheckBox.name)  >=0;

      })
      return matched5;
    };


  // ///////// end //////////
  }]);

</script>




// tablesort 
<script> 
  $('table').tablesorter({

      widgets: ['zebra'],

      sortList: [[0, 0], [2, 0]]
  });

  $('table').bind('sortBegin', function(e, tbl) {
      var c = tbl.config,
          list = c.sortList;
      // add date sort if not the initial sort, otherwise sort second column
      // (zero based index)
      list.push((list[0] && list[0][0] !== 2) ? [2, 0] : [1, 0]);
  });
</script>

