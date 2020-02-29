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

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function getWidgetsArray() {
  var widgets = [];
  var rows = document.querySelectorAll('#dashboard .row');
  rows.forEach(function (row, key) {
    var rowWidgets = row.querySelectorAll('.placeholder');
    var rkey = row.getAttribute('data-key');
    widgets[rkey] = [];
    rowWidgets.forEach(function (widget, wkey) {
      var name = widget.getAttribute('data-name');
      var size = widget.getAttribute('data-size');
      widgets = _objectSpread({}, widgets, _defineProperty({}, rkey, {
        "name": document.getElementById('row[' + rkey + ']').value,
        "widgets": _objectSpread({}, widgets[rkey]['widgets'], _defineProperty({}, name, size))
      }));
    });
  });
  document.getElementById('widgets_array').value = JSON.stringify(widgets);
}

$(document).ready(function () {
  $('.add-control').click(function () {
    if ($(this).attr('data-create')) {
      switch ($(this).attr('data-create')) {
        case "row":
          var html = "\n                        <div class=\"form-group px-0 col-md-3\">\n                            <input type=\"text\" id=\"row[".concat($('#dashboard .row').length, "]\" class=\"form-control\" placeholder=\"Name of row\" required>\n                        </div>\n                        <div class=\"row\" data-key=\"").concat($('#dashboard .row').length, "\"></div>\n                    ");
          $('#dashboard').append(html);
          break;
      }
    } else if ($(this).attr('data-add')) {
      var html = "\n                <div class=\"placeholder col-lg-".concat($(this).attr('data-size') * 4, "\" data-size=\"").concat($(this).attr('data-size'), "\" draggable=\"true\" id=\"").concat($(this).attr('data-name'), "\" data-name=\"").concat($(this).attr('data-add'), "\" ondragstart=\"drag(event)\">\n                    <div style=\"height: 65px;\" class=\"card my-2\">\n                        <div class=\"card-body\">\n                            <div class=\"card-title\">\n                                ").concat($(this).attr('data-title'), "\n                            </div>\n                        </div>\n                    </div>\n                </div>\n            ");
      $('#dashboard .row.active').append(html);
    }

    $('#dashboard .row').click(function () {
      $('#dashboard .row.active').removeClass('active');
      $(this).addClass('active');
    });
  });
  $('#dashboard .row').click(function () {
    $('#dashboard .row.active').removeClass('active');
    $(this).addClass('active');
  });
  $("#dashboard-form").submit(function () {
    getWidgetsArray();
  });
});

/***/ }),

/***/ 1:
/*!***********************************************!*\
  !*** multi ./resources/js/admin/dashboard.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\cms\resources\js\admin\dashboard.js */"./resources/js/admin/dashboard.js");


/***/ })

/******/ });