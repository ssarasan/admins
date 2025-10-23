/*------------------------------------------------------------------
    File Name: custom.js
    Template Name: Pluto - Responsive HTML5 Template
    Created By: html.design
    Envato Profile: https://themeforest.net/user/htmldotdesign
    Website: https://html.design
    Version: 1.0
-------------------------------------------------------------------*/

/*--------------------------------------
	sidebar
--------------------------------------*/

"use strict";

$(document).ready(function () {
  /*-- sidebar js --*/
  $('#sidebarCollapse').on('click', function () {
    $('#sidebar').toggleClass('active');
  });
  
  /*-- calendar js --*/
  $('#example14').calendar({
    inline: true,
    events: 'events.php?action=read',
        eventColor: '#378006'
  });
  });
  function handleCategoryClick(el) {
    console.log(el)
      let categoryName = el.getAttribute('data-category');
      let categoryId   = el.getAttribute('data-category-id');
      let dataManage   = el.getAttribute('data-manage');
      let dataUser     = el.getAttribute('data-user');
  
      console.log(categoryName);
  
      document.getElementById('page_title').innerHTML = '<h2>' + categoryName + '</h2>';
  
      fetch('/seonics-intranet/manage.php?' + encodeURIComponent(dataUser) +
            '&type=' + encodeURIComponent(dataManage) +
            '&category_name=' + encodeURIComponent(categoryName) +
            '&category_id=' + encodeURIComponent(categoryId))
          .then(response => response.text())
          .then(data => {
              document.getElementById('dashboard').innerHTML = data;
              $("#FileList").DataTable({stripeClasses: [ 'odd-row', 'even-row' ]});
          })
          .catch(error => console.error('Error fetching data:', error));
  }

  
  document.querySelectorAll('#categoryLinks a').forEach(link => {
            link.addEventListener('click', function(e) {
              e.preventDefault();
                 handleCategoryClick(this);
            });
  });

$(document).on("click", "#UpdatePost, #deletePost", function(e) {
    e.preventDefault();

    let categoryName = $(this).data('category');
    let postId   = $(this).data('id');
    let dataManage   = $(this).data('manage');
    let dataUser     = $(this).data('user');

    fetch('/seonics-intranet/manage.php?' + encodeURIComponent(dataUser) +
            '&type=' + encodeURIComponent(dataManage) +
            '&category_name=' + encodeURIComponent(categoryName) +
            '&post_id=' + encodeURIComponent(postId))
          .then(response => response.text())
          .then(data => {
            if(dataManage =='Delete'){
              location.reload();
            }else{
              document.getElementById('dashboard').innerHTML = data;
              $("#FileList").DataTable({stripeClasses: [ 'odd-row', 'even-row' ]});
            }
          })
          .catch(error => console.error('Error fetching data:', error));

    // $.ajax({
    //     url: "event.php",
    //     type: "POST",
    //     data: { 
    //         action: action, 
    //         documentId: docId,          // single id clicked
    //         allDocumentIds: documentIds // all ids if needed
    //     },
    //     success: function(response) {
    //         console.log(response);
    //         if(action === "Delete"){
    //             alert("Document " + docId + " deleted");
    //         } else {
    //             alert("Document " + docId + " update called");
    //         }
    //     },
    //     error: function() {
    //         alert("Something went wrong!");
    //     }
    // });
});

/*--------------------------------------
    scrollbar js
--------------------------------------*/

var ps = new PerfectScrollbar('#sidebar');
