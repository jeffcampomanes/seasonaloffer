<!DOCTYPE html>
<html ng-app="myapp">

<head>
    <meta charset="utf-8">

	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.6/angular.min.js"></script>
	<script src="https://mottie.github.io/tablesorter/dist/js/jquery.tablesorter.min.js"></script>
  <link  href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>


<body ng-controller="filterCtrl">

  <div class="container">
    
     <div class="row"> 

          <div class="col-md-12 text-center">
              <h3>Seasonal Offer Admin Page</h3>              
          </div>

      </div>


      <div class="row">
        <div class="col-md-12 text-center">
        
            <p><a title="Create New Offer" href="create.php" class="btn btn-success">Create New Offer</a> </p>

            <br>
            Search : <input type="text" value="" ng-model="search" />
            <br><br>

        </div>
        
      </div>



  <!-- SEARCH FUNCTION /  FILTERING MECHANISM FOR APPROVED/DEAD OFFERS  -->
    <div class="row">


      <div class="row-fluid">
            
              <br>
              filter:<br>
              choose status (approved OR not approved) and choose a country to see available offers.<br><br>

              <!-- LIVE OFFERS -->
              <label ng-repeat="approvedCheck in liveFilter">
                    <input class="inlineCheckbox" type="checkbox" ng-model="approvedCheck.selected"/>{{approvedCheck.name}}</label>

              <!-- DEAD OFFERS -->
              <label ng-repeat="notApprovedCheck in deadFilter">
                  <input class="inlineCheckbox" type="checkbox" ng-model="notApprovedCheck.selected"/>{{notApprovedCheck.name}}</label>

              <!-- US OFFERS -->
              <label ng-repeat="USCheckBox in USFilter">
                  <input class="inlineCheckbox" type="checkbox" ng-model="USCheckBox.selected"/>{{USCheckBox.name}}</label>

              <!-- CA OFFERS -->
              <label ng-repeat="CACheckBox in CAFilter">
                  <input class="inlineCheckbox" type="checkbox" ng-model="CACheckBox.selected"/>{{CACheckBox.name}}</label>

              <!-- AUS OFFERS -->
              <label ng-repeat="AUSCheckBox in AUSFilter">
                  <input class="inlineCheckbox" type="checkbox" ng-model="AUSCheckBox.selected"/>{{AUSCheckBox.name}}</label>
              
              <!-- UK OFFERS -->
              <label ng-repeat="UKCheckBox in UKFilter">
                  <input class="inlineCheckbox" type="checkbox" ng-model="UKCheckBox.selected"/>{{UKCheckBox.name}}</label>


        </div>


        <div class="col-md-12 text-center">
      


          <table class="table table-striped table-bordered">  
    
                <thead>
                   <tr>
                      <th>
                        <a href="#" ng-click="sortType = 'offer'; sortReverse = !sortReverse">offer
                          <span ng-show="sortType == 'offer' && !sortReverse" class="fa fa-caret-down"></span>
                          <span ng-show="sortType == 'offer' && sortReverse" class="fa fa-caret-up"></span>
                        </a>
                      </th>

                      <th>advertiser</th>
                      <th>start date</th>
                      <th>end date</th>
                      <th>country</th>
                      <th>status</th>
                      <th>id</th>
                      <th>action jackson</th>
                  </tr>
              </thead>

              <tbody>


                <tr ng-repeat="data in data | filter : search | filter:itemFilterLive | filter:itemFilterDead | filter:itemUSFilter | filter:itemCAFilter | filter:itemAUSFilter | filter:itemUKFilter | firstPage:currentPage*pageSize | limitTo:pageSize ">
                    <td>{{data.offer}}</td>
                    <td>{{data.advertiser}}</td>
                    <td>{{data.startdate}}</td>
                    <td>{{data.enddate}}</td>
                    <td>{{data.country}}</td>
                    <td>{{data.status}}</td>
                    <td>{{data.id}}</td>
                </tr>



              <div class="pagination">
                  <button ng-disabled="currentPage == 0" ng-click="currentPage=currentPage-1"><</button>
                  <span>{{currentPage+1}}/{{numberOfPages()}}</span>
                  <button ng-disabled="currentPage >= data.length/pageSize - 1" ng-click="currentPage=currentPage+1">></button>
              </div>    

              </tbody>
              </table>
              <hr>
              
          
               
              </tbody>

          </table>    
        </div>
    </div>



<script>

  var app = angular.module('myapp', []);

  // pagination filter
  app.filter('firstPage', function() {
    return function(input, start) {
    start = +start;
    return input.slice(start);
     }
  });


  // HTTP GET json
  app.controller('filterCtrl', ['$scope', '$http', function($scope,$http) {
    $scope.data =  $http.get("http://localhost/crud/php2json.php")
      .success(function(response) {$scope.data = response;});

  // pagination controller
      $scope.currentPage = 0;
      $scope.pageSize = 10;
      $scope.numberOfPages=function(){
         return Math.ceil($scope.data.length/$scope.pageSize);
  }

  // offer filter controller
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
    // $scope.sortType = ['offer'];
    // $scope.sortReverse  = [false];


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


<!-- ////////////////////////////////////////////////////////////////////////////// -->


    </div> <!-- /container -->
  </body>
</html>

