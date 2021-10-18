angular.module('fair', [])
.controller('fairCtrl', ['$scope','$window','$http',function($scope,$window,$http) {
  $scope.loading = true
  $scope.showing_quiz = false
  $scope.ans = null
  document.title = $window.config.title
  $scope.title = $window.config.title
  $scope.quizzes = $window.config.quizzes
  $scope.user = 'Loading...'
  $scope.score = 0
  $http.get(atob('aHR0cHM6Ly90aWNrZXQubmEueG9'+'tLmNvbS9hcGkvdXNlcg=='),{withCredentials:true})
  .then(function success(r){
    $scope.loading = false
    $scope.user_id = r.data.Login_ID
    $scope.user = r.data.Full_Name
  },function err(r){})

  $scope.open_quiz = function(quiz){
    $scope.ans = null
    $scope.showing_quiz = true
    $scope.current_quiz = quiz
  }

  $scope.close_quiz = function(){
    $scope.current_quiz = {}
    $scope.showing_quiz = false
    $scope.ans = null
  }

  $scope.submit_quiz = function(){
    if(!confirm("Are you sure you want to submit the quiz?"))return
    $scope.submitting_quiz = true
    if($scope.current_quiz.type=='checkbox' && $scope.ans){
      var _ans = []
      for([key, value] of Object.entries($scope.ans)){
        if(value) _ans.push(key)
      }
      $scope.ans = _ans
    }
    return $scope.close_quiz()
    $http.post('/adapter.php',{
      id: $scope.user_id,
      name: $scope.user,
      quiz_id: $scope.current_quiz.id,
      ans: $scope.ans
    }).then(function success(r){
      $scope.submitting_quiz = false
    },function err(r){})
    $scope.close_quiz()
  }

}])