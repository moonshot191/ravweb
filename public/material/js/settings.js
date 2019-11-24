$(document).ready(function() {
  $().ready(function() {
      $sidebar = $('.sidebar');

      $sidebar_img_container = $sidebar.find('.sidebar-background');

      $full_page = $('.full-page');

      $sidebar_responsive = $('body > .navbar-collapse');

      window_width = $(window).width();

      fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();
    
      /* if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
              $('.fixed-plugin .dropdown').addClass('open');
          }
      } */

      $('.fixed-plugin a').click(function(event) {
          if ($(this).hasClass('switch-trigger')) {
              if (event.stopPropagation) {
              event.stopPropagation();
              } else if (window.event) {
              window.event.cancelBubble = true;
              }
          }
      });

      $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
              $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
              $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
              $sidebar_responsive.attr('data-color', new_color);
          }
      });

      $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
              $sidebar.attr('data-background-color', new_color);
          }
      });

      $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');

          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
              $sidebar_img_container.fadeOut('fast', function() {
                  $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                  $sidebar_img_container.fadeIn('fast');
              });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
              var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

              $full_page_background.fadeOut('fast', function() {
                  $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                  $full_page_background.fadeIn('fast');
              });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
              var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
              var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
              $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
      });

      $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
              if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
              }

              if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
              }

              background_image = true;
          } else {
              if ($sidebar_img_container.length != 0) {
                  $sidebar.removeAttr('data-image');
                  $sidebar_img_container.fadeOut('fast');
              }

              if ($full_page_background.length != 0) {
                  $full_page.removeAttr('data-image', '#');
                  $full_page_background.fadeOut('fast');
              }

              background_image = false;
          }
      });

      $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
              $('body').removeClass('sidebar-mini');
              md.misc.sidebar_mini_active = false;

              $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

              $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

              setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
              }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
              window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
              clearInterval(simulateWindowResize);
          }, 1000);

      });
  });
});

$(document).ready(function() {
  md.checkFullPageBackgroundImage();
  setTimeout(function() {
      // after 1000 ms we add the class animated to the login/register card
      $('.card').removeClass('card-hidden');
  }, 700);


    $(document).on("click", "#record:not(.disabled)", function(){
        Fr.voice.record($("#live").is(":checked"), function(){
            $(".recordButton").addClass("disabled");

            $("#live").addClass("disabled");
            $(".one").removeClass("disabled");

            makeWaveform();
        });
    });

    $(document).on("click", "#recordFor5:not(.disabled)", function(){
        Fr.voice.record($("#live").is(":checked"), function(){
            $(".recordButton").addClass("disabled");

            $("#live").addClass("disabled");
            $(".one").removeClass("disabled");

            makeWaveform();
        });

        Fr.voice.stopRecordingAfter(5000, function(){
            alert("Recording stopped after 5 seconds");
        });
    });

    $(document).on("click", "#pause:not(.disabled)", function(){
        if($(this).hasClass("resume")){
            Fr.voice.resume();
            $(this).replaceWith('<a class="button one" id="pause">Pause</a>');
        }else{
            Fr.voice.pause();
            $(this).replaceWith('<a class="button one resume" id="pause">Resume</a>');
        }
    });

    $(document).on("click", "#stop:not(.disabled)", function(){
        restore();
    });

    $(document).on("click", "#play:not(.disabled)", function(){
        if($(this).parent().data("type") === "mp3"){
            Fr.voice.exportMP3(function(url){
                $("#audio").attr("src", url);
                $("#audio")[0].play();
            }, "URL");
        }else{
            Fr.voice.export(function(url){
                $("#audio").attr("src", url);
                $("#audio")[0].play();
            }, "URL");
        }
        restore();
    });

    $(document).on("click", "#download:not(.disabled)", function(){
        if($(this).parent().data("type") === "mp3"){
            Fr.voice.exportMP3(function(url){
                $("<a href='" + url + "' download='MyRecording.mp3'></a>")[0].click();
            }, "URL");
        }else{
            Fr.voice.export(function(url){
                $("<a href='" + url + "' download='MyRecording.wav'></a>")[0].click();
            }, "URL");
        }
        restore();
    });

    $(document).on("click", "#base64:not(.disabled)", function(){
        if($(this).parent().data("type") === "mp3"){
            Fr.voice.exportMP3(function(url){
                console.log("Here is the base64 URL : " + url);
                alert("Check the web console for the URL");

                $("<a href='"+ url +"' target='_blank'></a>")[0].click();
            }, "base64");
        }else{
            Fr.voice.export(function(url){
                console.log("Here is the base64 URL : " + url);
                alert("Check the web console for the URL");

                $("<a href='"+ url +"' target='_blank'></a>")[0].click();
            }, "base64");
        }
        restore();
    });

    $(document).on("click", "#save:not(.disabled)", function(){
        function upload(blob){
            var formData = new FormData();
            formData.append('file', blob);

            $.ajax({
                url: "upload.php",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(url) {
                    $("#audio").attr("src", url);
                    $("#audio")[0].play();
                    alert("Saved In Server. See audio element's src for URL");
                }
            });
        }
        if($(this).parent().data("type") === "mp3"){
            Fr.voice.exportMP3(upload, "blob");
        }else{
            Fr.voice.export(upload, "blob");
        }
        restore();
    });
});

function restore(){
    $("#record, #live").removeClass("disabled");
    $("#pause").replaceWith('<a class="button one" id="pause">Pause</a>');
    $(".one").addClass("disabled");
    Fr.voice.stop();
}

function makeWaveform(){
    var analyser = Fr.voice.recorder.analyser;

    var bufferLength = analyser.frequencyBinCount;
    var dataArray = new Uint8Array(bufferLength);

    /**
     * The Waveform canvas
     */
    var WIDTH = 500,
        HEIGHT = 200;

    var canvasCtx = $("#level")[0].getContext("2d");
    canvasCtx.clearRect(0, 0, WIDTH, HEIGHT);

    function draw() {
        var drawVisual = requestAnimationFrame(draw);

        analyser.getByteTimeDomainData(dataArray);

        canvasCtx.fillStyle = 'rgb(200, 200, 200)';
        canvasCtx.fillRect(0, 0, WIDTH, HEIGHT);
        canvasCtx.lineWidth = 2;
        canvasCtx.strokeStyle = 'rgb(0, 0, 0)';

        canvasCtx.beginPath();

        var sliceWidth = WIDTH * 1.0 / bufferLength;
        var x = 0;
        for(var i = 0; i < bufferLength; i++) {
            var v = dataArray[i] / 128.0;
            var y = v * HEIGHT/2;

            if(i === 0) {
                canvasCtx.moveTo(x, y);
            } else {
                canvasCtx.lineTo(x, y);
            }

            x += sliceWidth;
        }
        canvasCtx.lineTo(WIDTH, HEIGHT/2);
        canvasCtx.stroke();
    };
    draw();
}

// $(document).ready(function(){
//
// });
