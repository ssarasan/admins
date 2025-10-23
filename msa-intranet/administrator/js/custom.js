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
  $('#UpdatePost').on('click', function () {
    alert("here");
    let categoryName = this.getAttribute('data-category');
    let categoryId = this.getAttribute('data-category-id');
    let dataManage = this.getAttribute('data-manage');
    console.log(dataManage)
    document.getElementById('page_title').innerHTML = '<h2> ' + dataManage + ' ' + categoryName + '</h2>';
    fetch('manage.php?type=' + dataManage + '&category_name=' + encodeURIComponent(categoryName) + '&category_id=' + encodeURIComponent(categoryId))
      .then(response => response.text())
      .then(data => {
        // console.log(data)
        document.getElementById('dashboard').innerHTML = data;
        $("#FileList").DataTable();
        $('#example14').calendar({ inline: true });
      })
      .catch(error => console.error('Error fetching data:', error));
  });
  /*-- calendar js --*/

  // $('#example15').calendar();
  /*-- tooltip js --*/
  // $('[data-toggle="tooltip"]').tooltip();

  document.querySelectorAll('#categoryLinks a').forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      link.addEventListener("show.bs.collapse", function () {
    let parentLi = this.closest("li");
    console.log("Expanded →", parentLi);
  });

  link.addEventListener("hide.bs.collapse", function () {
    let parentLi = this.closest("li");
    console.log("Collapsed →", parentLi);
  });
      let categoryName = this.getAttribute('data-category');
      let categoryIconId = categoryName + '-fa-icon'; 
      let categoryIcon = document.getElementById(categoryName);

      categoryIcon.addEventListener('shown.bs.collapse', function () {
          $('#'+categoryIconId).removeClass('fa-angle-right');
          $('#'+categoryIconId).addClass('fa-angle-down');
          console.log("expand")
        });
        categoryIcon.addEventListener('hidden.bs.collapse', function () {
          $('#'+categoryIconId).removeClass('fa-angle-down');
          $('#'+categoryIconId).addClass('fa-angle-right');
          console.log("collapse")
      });
      // $('#'+categoryIconId).addClass('fa-angle-down');
      let categoryId = this.getAttribute('data-category-id');
      let dataManage = this.getAttribute('data-manage');
      console.log(categoryName)
      document.getElementById('page_title').innerHTML = '<h2> ' + (dataManage == null || dataManage =='') ?'': dataManage + ' ' + (categoryName == null || categoryName                                            == '') ?'': categoryName + '</h2>';
      fetch('manage.php?type=' + dataManage + '&category_name=' + encodeURIComponent(categoryName) + '&category_id=' + encodeURIComponent(categoryId))
        .then(response => response.text())
        .then(data => {
          // console.log(data)
          document.getElementById('dashboard').innerHTML = data;
          $("#FileList").DataTable();
          $('#example14').calendar({ inline: true });
        })
        .catch(error => console.error('Error fetching data:', error));
    });
  });
});

document.querySelectorAll('#categoryLinks .collapse').forEach(collapseEl => {
  // When expanded
  collapseEl.addEventListener('shown.bs.collapse', function () {
    let parentLi = this.closest('li');
    let icon = parentLi.querySelector('i.fa-angle-right, i.fa-angle-down');
    if (icon) {
      icon.classList.remove('fa-angle-right');
      icon.classList.add('fa-angle-down');
    }
    console.log("Expanded →", this.id);
  });

  // When collapsed
  collapseEl.addEventListener('hidden.bs.collapse', function () {
    let parentLi = this.closest('li');
    let icon = parentLi.querySelector('i.fa-angle-right, i.fa-angle-down');
    if (icon) {
      icon.classList.remove('fa-angle-down');
      icon.classList.add('fa-angle-right');
    }
    console.log("Collapsed →", this.id);
  });
});


/*--------------------------------------
    scrollbar js
--------------------------------------*/

var ps = new PerfectScrollbar('#sidebar');

