jQuery(document).ready(function ($) {
  // Add the cursor icon element to the body
  if ($("#ccfnt-icon").length === 0) {
    $("body").append(
      '<div id="ccfnt-icon" style="font-size: ' +
        ccfntSettings.size +
        "px; transform: translate(" +
        ccfntSettings.position_x +
        "px, " +
        ccfntSettings.position_y +
        'px);"><i class="' +
        ccfntSettings.icon +
        '"></i></div>'
    );
  }

  // Variables for cursor follow
  var cursorIcon = $("#ccfnt-icon");
  var mouseX = 0,
    mouseY = 0;
  var posX = 0,
    posY = 0;
  var delay = parseInt(ccfntSettings.speed);
  var prevScroll = 0;

  // Track mouse position
  $(document).mousemove(function (e) {
    mouseX = e.pageX;
    mouseY = e.pageY;
  });

  // Update mouseY based on scroll position
  $(window).scroll(function () {
    var scroll = $(window).scrollTop();
    mouseY += scroll - prevScroll;
    prevScroll = scroll;
  });

  // Follow the cursor with a delay and keep within boundaries
  function followCursor() {
    posX += (mouseX - posX) / delay;
    posY += (mouseY - posY) / delay;

    // Get viewport boundaries
    var windowWidth = $(document).width();
    var windowHeight = $(document).height();
    var iconWidth = cursorIcon.outerWidth();
    var iconHeight = cursorIcon.outerHeight();

    // Boundary checks for X-axis
    if (posX < 0) posX = 0;
    if (posX > windowWidth - iconWidth - ccfntSettings.position_x)
      posX = windowWidth - iconWidth - ccfntSettings.position_x;

    // Boundary checks for Y-axis
    if (posY < 0) posY = 0;
    if (posY > windowHeight - iconHeight - ccfntSettings.position_y)
      posY = windowHeight - iconHeight - ccfntSettings.position_y;

    // Set position
    cursorIcon.css({
      left: posX + "px",
      top: posY + "px",
    });

    // Call the function again to follow the cursor with a delay
    requestAnimationFrame(followCursor);
  }

  followCursor();
});
