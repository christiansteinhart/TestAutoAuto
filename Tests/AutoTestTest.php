<?php

class AutoTestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \TestAutoAuto\WebDriver\WebdriverFactory
     */
    private static $webdriverFactory;

    /**
     * @var \Facebook\WebDriver\WebDriver
     */
    private $driver;

    public static function setUpBeforeClass()
    {
        self::$webdriverFactory = new \TestAutoAuto\WebDriver\WebdriverFactory("http://localhost:4444/wd/hub", 5000);
    }

    protected function setUp()
    {
        $this->driver = self::$webdriverFactory->getChromeDriver();
    }

    protected function tearDown()
    {
        $this->driver->close();
    }
    
	public function testCase1() {
		$this->driver->get('file:///Users/christiansteinhart/TestApp/testApp.html');
		$element = $this->driver->findElement(
			Facebook\WebDriver\WebDriverBy::cssSelector('a[href=\'about.html\']')
		);
		$element->click();

		$this->assertEquals('file:///Users/christiansteinhart/TestApp/testApp.html', $this->driver->getCurrentUrl());
		$this->assertEquals('<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml" lang="en"><head><style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}.ng-animate-shim{visibility:hidden;}.ng-anchor{position:absolute;}</style>
  <meta charset="UTF-8" />
  <title>TestApp</title> 
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
</head>
<body ng-app="testApp" class="ng-scope">
  <script>
  angular.module(\'testApp\', [])
    .controller(\'LoginController\', [\'$scope\', function($scope) {
      $scope.email = \'\';
      $scope.password = \'\';
      $scope.verification = false;
      $scope.loginFail = false;
      
      $scope.login = function() {
        $scope.enableVerification();

        if ($scope.email=="correct@email.com" &amp;&amp; $scope.password=="asd123") {
          console.log(\'LOGIN\');
          window.location.href = \'./logged.html\';
        }

        $scope.loginFail = true;;
        return false;
      }
      
      $scope.enableVerification = function() {
        $scope.verification = true; 
      }
       
    }]);
</script>
  <form name="loginForm" ng-controller="LoginController" ng-submit="login()" novalidate="" class="ng-pristine ng-scope ng-valid-email ng-invalid ng-invalid-required">
    <label>Email:
      <input type="email" name="input" ng-model="email" required="" ng-blur="enableVerification()" class="ng-pristine ng-untouched ng-empty ng-valid-email ng-invalid ng-invalid-required" />
    </label>
    <div role="alert">
      <span class="error ng-hide" ng-show="loginForm.input.$error.required &amp;&amp; verification">Required!</span>
      <span class="error ng-hide" ng-show="loginForm.input.$error.email &amp;&amp; verification">Not valid email!</span>
    </div>
    <label>Password:
      <input type="password" name="password" ng-model="password" class="ng-pristine ng-untouched ng-valid ng-empty" />
    </label>
    <button type="submit">Login</button>
    <div role="alert">
      <span class="error ng-hide" ng-show="loginFail">Login fehlgeschlagen</span>
    </div>
  </form>
  <a href="about.html">Link</a>


</body></html>', $this->driver->getPageSource());

	}

	public function testCase2() {
		$this->driver->get('file:///Users/christiansteinhart/TestApp/testApp.html');
		$element = $this->driver->findElement(
			Facebook\WebDriver\WebDriverBy::cssSelector('button[type=submit]')
		);
		$element->click();

		$this->assertEquals('file:///Users/christiansteinhart/TestApp/testApp.html', $this->driver->getCurrentUrl());
		$this->assertEquals('<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml" lang="en"><head><style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}.ng-animate-shim{visibility:hidden;}.ng-anchor{position:absolute;}</style>
  <meta charset="UTF-8" />
  <title>TestApp</title> 
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
</head>
<body ng-app="testApp" class="ng-scope">
  <script>
  angular.module(\'testApp\', [])
    .controller(\'LoginController\', [\'$scope\', function($scope) {
      $scope.email = \'\';
      $scope.password = \'\';
      $scope.verification = false;
      $scope.loginFail = false;
      
      $scope.login = function() {
        $scope.enableVerification();

        if ($scope.email=="correct@email.com" &amp;&amp; $scope.password=="asd123") {
          console.log(\'LOGIN\');
          window.location.href = \'./logged.html\';
        }

        $scope.loginFail = true;;
        return false;
      }
      
      $scope.enableVerification = function() {
        $scope.verification = true; 
      }
       
    }]);
</script>
  <form name="loginForm" ng-controller="LoginController" ng-submit="login()" novalidate="" class="ng-pristine ng-scope ng-valid-email ng-invalid ng-invalid-required">
    <label>Email:
      <input type="email" name="input" ng-model="email" required="" ng-blur="enableVerification()" class="ng-pristine ng-untouched ng-empty ng-valid-email ng-invalid ng-invalid-required" />
    </label>
    <div role="alert">
      <span class="error ng-hide" ng-show="loginForm.input.$error.required &amp;&amp; verification">Required!</span>
      <span class="error ng-hide" ng-show="loginForm.input.$error.email &amp;&amp; verification">Not valid email!</span>
    </div>
    <label>Password:
      <input type="password" name="password" ng-model="password" class="ng-pristine ng-untouched ng-valid ng-empty" />
    </label>
    <button type="submit">Login</button>
    <div role="alert">
      <span class="error ng-hide" ng-show="loginFail">Login fehlgeschlagen</span>
    </div>
  </form>
  <a href="about.html">Link</a>


</body></html>', $this->driver->getPageSource());

	}

	public function testCase3() {
		$this->driver->get('file:///Users/christiansteinhart/TestApp/testApp.html');
		$element = $this->driver->findElement(
			Facebook\WebDriver\WebDriverBy::cssSelector('input[type=email][name=input]')
		);
		$element->click();

		$this->assertEquals('file:///Users/christiansteinhart/TestApp/testApp.html', $this->driver->getCurrentUrl());
		$this->assertEquals('<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml" lang="en"><head><style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}.ng-animate-shim{visibility:hidden;}.ng-anchor{position:absolute;}</style>
  <meta charset="UTF-8" />
  <title>TestApp</title> 
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
</head>
<body ng-app="testApp" class="ng-scope">
  <script>
  angular.module(\'testApp\', [])
    .controller(\'LoginController\', [\'$scope\', function($scope) {
      $scope.email = \'\';
      $scope.password = \'\';
      $scope.verification = false;
      $scope.loginFail = false;
      
      $scope.login = function() {
        $scope.enableVerification();

        if ($scope.email=="correct@email.com" &amp;&amp; $scope.password=="asd123") {
          console.log(\'LOGIN\');
          window.location.href = \'./logged.html\';
        }

        $scope.loginFail = true;;
        return false;
      }
      
      $scope.enableVerification = function() {
        $scope.verification = true; 
      }
       
    }]);
</script>
  <form name="loginForm" ng-controller="LoginController" ng-submit="login()" novalidate="" class="ng-pristine ng-scope ng-valid-email ng-invalid ng-invalid-required">
    <label>Email:
      <input type="email" name="input" ng-model="email" required="" ng-blur="enableVerification()" class="ng-pristine ng-untouched ng-empty ng-valid-email ng-invalid ng-invalid-required" />
    </label>
    <div role="alert">
      <span class="error ng-hide" ng-show="loginForm.input.$error.required &amp;&amp; verification">Required!</span>
      <span class="error ng-hide" ng-show="loginForm.input.$error.email &amp;&amp; verification">Not valid email!</span>
    </div>
    <label>Password:
      <input type="password" name="password" ng-model="password" class="ng-pristine ng-untouched ng-valid ng-empty" />
    </label>
    <button type="submit">Login</button>
    <div role="alert">
      <span class="error ng-hide" ng-show="loginFail">Login fehlgeschlagen</span>
    </div>
  </form>
  <a href="about.html">Link</a>


</body></html>', $this->driver->getPageSource());

	}

	public function testCase4() {
		$this->driver->get('file:///Users/christiansteinhart/TestApp/testApp.html');
		$element = $this->driver->findElement(
			Facebook\WebDriver\WebDriverBy::cssSelector('input[type=password][name=password]')
		);
		$element->click();

		$this->assertEquals('file:///Users/christiansteinhart/TestApp/testApp.html', $this->driver->getCurrentUrl());
		$this->assertEquals('<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml" lang="en"><head><style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}.ng-animate-shim{visibility:hidden;}.ng-anchor{position:absolute;}</style>
  <meta charset="UTF-8" />
  <title>TestApp</title> 
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
</head>
<body ng-app="testApp" class="ng-scope">
  <script>
  angular.module(\'testApp\', [])
    .controller(\'LoginController\', [\'$scope\', function($scope) {
      $scope.email = \'\';
      $scope.password = \'\';
      $scope.verification = false;
      $scope.loginFail = false;
      
      $scope.login = function() {
        $scope.enableVerification();

        if ($scope.email=="correct@email.com" &amp;&amp; $scope.password=="asd123") {
          console.log(\'LOGIN\');
          window.location.href = \'./logged.html\';
        }

        $scope.loginFail = true;;
        return false;
      }
      
      $scope.enableVerification = function() {
        $scope.verification = true; 
      }
       
    }]);
</script>
  <form name="loginForm" ng-controller="LoginController" ng-submit="login()" novalidate="" class="ng-pristine ng-scope ng-valid-email ng-invalid ng-invalid-required">
    <label>Email:
      <input type="email" name="input" ng-model="email" required="" ng-blur="enableVerification()" class="ng-pristine ng-untouched ng-empty ng-valid-email ng-invalid ng-invalid-required" />
    </label>
    <div role="alert">
      <span class="error ng-hide" ng-show="loginForm.input.$error.required &amp;&amp; verification">Required!</span>
      <span class="error ng-hide" ng-show="loginForm.input.$error.email &amp;&amp; verification">Not valid email!</span>
    </div>
    <label>Password:
      <input type="password" name="password" ng-model="password" class="ng-pristine ng-untouched ng-valid ng-empty" />
    </label>
    <button type="submit">Login</button>
    <div role="alert">
      <span class="error ng-hide" ng-show="loginFail">Login fehlgeschlagen</span>
    </div>
  </form>
  <a href="about.html">Link</a>


</body></html>', $this->driver->getPageSource());

	}


}