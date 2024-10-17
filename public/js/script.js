jQuery(document).ready(function ($) {
  // Add the cursor icon element to the body
  $("body").append(
    '<div id="ccfnt-icon" style="font-size: ' +
      ccfntCursorSettings.size +
      "px; transform: translate(" +
      ccfntCursorSettings.position_x +
      "px, " +
      ccfntCursorSettings.position_y +
      'px);"><i class="' +
      ccfntCursorSettings.icon +
      '"></i></div>'
  );

  // Variables for cursor follow
  var cursorIcon = $("#ccfnt-icon");
  var mouseX = 0,
    mouseY = 0;
  var posX = 0,
    posY = 0;
  var delay = parseInt(ccfntCursorSettings.speed);

  // Track mouse position
  $(document).mousemove(function (e) {
    mouseX = e.pageX;
    mouseY = e.pageY;
  });

  // Follow the cursor with a delay
  function followCursor() {
    posX += (mouseX - posX) / delay;
    posY += (mouseY - posY) / delay;

    cursorIcon.css({
      left: posX + "px",
      top: posY + "px",
    });

    requestAnimationFrame(followCursor);
  }

  followCursor();
});
