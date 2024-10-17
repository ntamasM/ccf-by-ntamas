jQuery(document).ready(function ($) {
  // Add the cursor icon element to the body
  $("body").append(
    '<div id="ntamas-cursor-icon" style="font-size: ' +
      ntamasCursorSettings.size +
      "px; transform: translate(" +
      ntamasCursorSettings.position_x +
      "px, " +
      ntamasCursorSettings.position_y +
      'px);"><i class="' +
      ntamasCursorSettings.icon +
      '"></i></div>'
  );

  // Variables for cursor follow
  var cursorIcon = $("#ntamas-cursor-icon");
  var mouseX = 0,
    mouseY = 0;
  var posX = 0,
    posY = 0;
  var delay = parseInt(ntamasCursorSettings.speed);

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
