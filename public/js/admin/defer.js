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

/***/ "./resources/js/admin/defer.js":
/*!*************************************!*\
  !*** ./resources/js/admin/defer.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // TinyMCE //
  if ($('.tinymce').length > 0) {
    // tinymce.init({
    //     selector: 'textarea',
    //     height: 500,
    //     theme: 'modern',
    //     plugins: 'print preview fullpage powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help',
    //     toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
    //     image_advtab: true,
    //     templates: [
    //       { title: 'Test template 1', content: 'Test 1' },
    //       { title: 'Test template 2', content: 'Test 2' }
    //     ],
    //     content_css: [
    //       '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    //       '//www.tinymce.com/css/codepen.min.css'
    //     ]
    //    });
    var editor_config = {
      path_absolute: "/",
      selector: "textarea.tinymce",
      plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
      toolbar1: "undo redo | styleselect formatselect insertfile | bold italic strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | outdent indent | removeformat",
      toolbar2: 'bullist numlist | link image media numlist bullist',
      relative_urls: false,
      file_browser_callback: function file_browser_callback(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;
        var cmsURL = editor_config.path_absolute + 'admin/filemanager?field_name=' + field_name;

        if (type == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.open({
          file: cmsURL,
          title: 'Filemanager',
          width: x * 0.8,
          height: y * 0.8,
          resizable: "yes",
          close_previous: "no"
        });
      }
    };
    tinymce.init(editor_config);
  } // MASS EDIT //


  var selectAll = $('.select-all');
  selectAll.change(function () {
    selectAll.closest('table').find('input').prop('checked', selectAll.prop('checked'));
  });
  $("#mass_action").change(function (e) {
    $(".mass_edit_sub").hide();

    if ($("#" + e.target.value)) {
      $("#" + e.target.value).show();
    }
  }); // LOGS //

  $('#filter-button').click(function () {
    var crud = document.getElementById('log-crud').value;
    var type = document.getElementById('log-type').value;
    $("#logs-table .alert").each(function () {
      if (($(this).attr('data-crud') == crud || crud === "0") && ($(this).attr('data-type') == type || type === "0")) {
        $(this).show();
      } else if (crud == 0 && type == 0) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });
});

/***/ }),

/***/ 2:
/*!*******************************************!*\
  !*** multi ./resources/js/admin/defer.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\cms\resources\js\admin\defer.js */"./resources/js/admin/defer.js");


/***/ })

/******/ });