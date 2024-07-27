/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************!*\
  !*** ./resources/js/pages/datatables.init.js ***!
  \***********************************************/
/*
Template Name: Minible - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Datatables Js File
*/
$(document).ready(function () {
  $('#datatable').DataTable();

  var table = $('#datatable-buttons').DataTable({
      lengthChange: false,
      buttons: [
          'copy', 'excel', 'pdf', 'colvis'
      ]
  });

  // Move buttons container to the desired position
  table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
  
  // Optional: Add Bootstrap form styling to DataTables length dropdown
  $(".dataTables_length select").addClass('form-select form-select-sm');
});

/******/ })()
;