/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/admin/dashboard.js":
/*!*****************************************!*\
  !*** ./resources/js/admin/dashboard.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function resizeElementContent(sizeX, sizeY, el) {
  for (var i = 1; i < 10; i++) {
    if (i < sizeY) {
      $(el).find(".hide-y-" + i).show();
      $(el).find(".show-y-" + i).hide();
    } else {
      $(el).find(".hide-y-" + i).hide();
      $(el).find(".show-y-" + i).show();
    }
  }

  for (var i = 1; i < 10; i++) {
    if (i < sizeX) {
      $(el.el).find(".hide-x-" + i).show();
      $(el.el).find(".show-x-" + i).hide();
    } else {
      $(el.el).find(".hide-x-" + i).hide();
      $(el.el).find(".show-x-" + i).show();
    }
  }
}

$(document).ready(function () {
  $(".grid-stack-item").each(function () {
    var sizeY = $(this).data("gs-height");
    var sizeX = $(this).data("gs-width");
    $(this).removeAttr("id");
    resizeElementContent(sizeX, sizeY, this);
  });
  $(".widget-remove").click(function () {
    $(this).closest(".grid-stack-item").remove();
    saveDashboard();
  });
  var grid = GridStack.init();
  grid.on("change", function (grid, items) {
    saveDashboard();
    items.forEach(function (el) {
      var sizeY = el.height;
      var sizeX = el.width;
      resizeElementContent(sizeX, sizeY, el.el);
    });
  });
  $("#dashboard-components").slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 2,
    arrows: true
  });
  $("#dashboard-components .slick-arrow").hide();
  $("#toggle-components").click(function () {
    var components = $("#dashboard-components");
    setTimeout(function () {
      if (!components.hasClass("active")) {
        $("#toggle-components").addClass("active");
        $("#dashboard-components").addClass("active");
        $("#dashboard-components").slick("setPosition");
        document.getElementById("dashboard-components").scrollIntoView();
        setTimeout(function () {
          $("#dashboard-components .slick-arrow").fadeIn(40);
        }, 10);
      } else {
        $("#toggle-components").removeClass("active");
        $("#dashboard-components").removeClass("active");
        $("#dashboard-components .slick-arrow").fadeOut(40);
      }
    }, 100);
  });
});

/***/ }),

/***/ 1:
/*!***********************************************!*\
  !*** multi ./resources/js/admin/dashboard.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\laragon\www\cms\resources\js\admin\dashboard.js */"./resources/js/admin/dashboard.js");


/***/ })

/******/ });