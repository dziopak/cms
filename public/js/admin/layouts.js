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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/admin/layouts.js":
/*!***************************************!*\
  !*** ./resources/js/admin/layouts.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

$(document).ready(function () {
  GridStack.init({
    acceptWidgets: true,
    animate: true,
    minRow: 10
  });
  $(".grid-stack").change(function () {
    $(".grid-stack-item").click(function () {
      var key = $(this).attr("data-gs-key");
      $(".block-settings").fadeOut("50");

      if (key) {
        setTimeout(function () {
          $("#fade").fadeIn("100");
          $('.block-settings[key="' + key + '"]').fadeIn("100");
        }, 300);
      }
    });
  });
  $(".block-title").change(function () {
    var title = $(this).val();
    var key = $(this).closest(".block-settings").attr("key");
    $('.grid-stack-item[data-gs-key="' + key + '"] .card-title strong').text(title);
  });
  $(".grid-stack-item").click(function () {
    var key = $(this).attr("data-gs-key");
    $(".block-settings").fadeOut("50");

    if (key) {
      setTimeout(function () {
        $("#fade").fadeIn("100");
        $('.block-settings[key="' + key + '"]').fadeIn("100");
      }, 300);
    }
  });
  $(".grid-stack-item .block-settings *").click(function (event) {
    event.stopPropagation();
  });
  $(".grid-stack-item .widget-container").click(function (event) {
    event.preventDefault();
    event.stopPropagation();
    $(this).toggleClass("active");
    var key = $(this).attr("data-key");

    if ($(this).hasClass("active")) {
      $('input[name="config[' + key + '][container]"]').attr("value", "true");
    } else {
      $('input[name="config[' + key + '][container]"]').attr("value", "false");
    }
  });
  $("#fade, .block-settings button").click(function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    $("#fade").fadeOut("100");
    $(".block-settings").fadeOut("100");
  });
  $(".block-settings").click(function (e) {
    e.preventDefault();
  });
  $(".widget-remove").click(function () {
    $(this).closest(".grid-stack-item").remove();
  });
  $("#toggle-components").click(function () {
    var components = $("#layout-components, #existing-components");
    setTimeout(function () {
      if (!components.hasClass("active")) {
        $("#toggle-components").addClass("active");
        components.addClass("active");
        components.slick("setPosition");
        document.getElementById("layout-components").scrollIntoView();
        setTimeout(function () {
          $("#layout-components .slick-arrow, #existing-components .slick-arrow").fadeIn(40);
        }, 10);
      } else {
        components.removeClass("active");
        components.removeClass("active");
        $("#layout-components .slick-arrow, #existing-components .slick-arrow").fadeOut(40);
      }
    }, 100);
  });
  $('button[type="submit"]').click(function (e) {
    e.preventDefault();
    var items = [];
    $(".grid-stack-item").each(function () {
      var $this = $(this);
      var key = $this.attr("data-gs-key");
      var config;
      $("input[name^='config[" + key + "]'], select[name^='config[" + key + "]']").each(function () {
        var value = $(this).val();

        if (value) {
          var name = $(this).attr("name");
          name = name.split(/[[\]]{1,2}/);
          config = _objectSpread(_objectSpread({}, config), {}, _defineProperty({}, name[2], $(this).val()));
        }
      });
      var data = {
        x: $this.attr("data-gs-x"),
        y: $this.attr("data-gs-y"),
        w: $this.attr("data-gs-width"),
        h: $this.attr("data-gs-height"),
        type: $this.attr("data-gs-block") || $this.attr("data-gs-widget"),
        id: $this.attr("data-gs-block-id"),
        key: key,
        config: config
      };
      items.push(data);
    });

    if ($("#result").length > 0) {
      $("#result").val(JSON.stringify(items));
    } else {
      var html = "<input type=\"hidden\" id=\"result\" value='".concat(JSON.stringify(items), "' name=\"result\">");
      $("#LayoutUpdateForm, #LayoutCreateForm").append(html);
    }

    $("#LayoutUpdateForm, #LayoutCreateForm").submit();
  });
  $(".components-bar").slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 2,
    arrows: true
  });
  $(".components-bar .slick-arrow").hide();
});
$(document).ready(function () {
  $(".widget-container").each(function () {
    var container = $(this).closest(".card").find(".with-container").val();

    if (container == true) {
      $(this).addClass("active");
    }
  });
});

/***/ }),

/***/ 2:
/*!*********************************************!*\
  !*** multi ./resources/js/admin/layouts.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\laragon\www\cms\resources\js\admin\layouts.js */"./resources/js/admin/layouts.js");


/***/ })

/******/ });