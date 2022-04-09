/*!
    * Start Bootstrap - SB Admin v7.0.3 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2021 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});
// // Function to shuffle the demo data
//     function shuffle(str) {
//     return str
//     .split('')
//     .sort(function() {
//     return 0.5 - Math.random();
//     })
//     .join('');
//     }
    
//     // For demonstration purposes we first make
//     // a huge array of demo data (20 000 items)
//     // HEADS UP; for the _.map function i use underscore (actually lo-dash) here
//     function mockData() {
//     return _.map(_.range(1, 20000), function(i) {
//     return {
//     id: i,
//     text: shuffle('te ststr ing to shuffle') + ' ' + i,
//     };
//     });
//     }
//     (function() {
//     // init select 2
//     $('#supplierSelect').select2({
//     theme: "bootstrap-5",   
//     data: mockData(),
//     placeholder: 'search',
//     multiple: true,
//     // query with pagination
//     query: function(q) {
//     var pageSize,
//     results,
//     that = this;
//     pageSize = 20; // or whatever pagesize
//     results = [];
//     if (q.term && q.term !== '') {
//     // HEADS UP; for the _.filter function i use underscore (actually lo-dash) here
//     results = _.filter(that.data, function(e) {
//     return e.text.toUpperCase().indexOf(q.term.toUpperCase()) >= 0;
//     });
//     } else if (q.term === '') {
//     results = that.data;
//     }
//     q.callback({
//     results: results.slice((q.page - 1) * pageSize, q.page * pageSize),
//     more: results.length >= q.page * pageSize,
//     });
//     },
//     });
//     })();   
