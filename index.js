$(function() {
  var width = 200,
    height = 44 * 4 + 20,
    speed = 300,
    button = $("#menu-button"),
    overlay = $("#overlay"),
    menu = $("#hamburger-menu");

  button.on("click", function(e) {
    if (overlay.hasClass("open")) {
      animate_menu("close");
    } else {
      animate_menu("open");
    }
  });

  overlay.on("click", function(e) {
    if (overlay.hasClass("open")) {
      animate_menu("close");
    }
  });

  $('a[href="#"]').on("click", function(e) {
    e.preventDefault();
  });

  function animate_menu(menu_toggle) {
    if (menu_toggle == "open") {
      overlay.addClass("open");
      button.addClass("on");
      overlay.animate({ opacity: 1 }, speed);
      menu.animate({ width: width, height: height }, speed);
    }

    if (menu_toggle == "close") {
      button.removeClass("on");
      overlay.animate({ opacity: 0 }, speed);
      overlay.removeClass("open");
      menu.animate({ width: "0", height: 0 }, speed);
    }
  }
});

// EDIT.PHP

const clickEvent = document.getElementsByClassName("tablinks");
clickEvent.addEventListener("click", openCity());

function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
