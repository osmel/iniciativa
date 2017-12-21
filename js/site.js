$(document).ready(function(){
  var opts = {
    lines: 13, // The number of lines to draw
    length: 20, // The length of each line
    width: 10, // The line thickness
    radius: 30, // The radius of the inner circle
    corners: 1, // Corner roundness (0..1)
    rotate: 0, // The rotation offset
    direction: 1, // 1: clockwise, -1: counterclockwise
    color: '#0090C7', // #rgb or #rrggbb or array of colors
    speed: 1, // Rounds per second
    trail: 60, // Afterglow percentage
    shadow: false, // Whether to render a shadow
    hwaccel: false, // Whether to use hardware acceleration
    className: 'spinner', // The CSS class to assign to the spinner
    zIndex: 2e9, // The z-index (defaults to 2000000000)
    top: 'auto', // Top position relative to parent in px
    left: 'auto' // Left position relative to parent in px
  };

  var target = document.getElementById('foo');

  $('#login_form').submit(function(){
    $('#foo').css('display','block');
    var spinner = new Spinner(opts).spin(target);
    $(this).ajaxSubmit({
      success: function(data){
        if(data != true){
          $('#messages').html(data);
          $('#messages').hide().slideDown("slow");
          $("#messages").delay(2500).slideUp(800, function(){
              spinner.stop();
              $('#foo').css('display','none');
              $("#messages").html("");
          });
        }else{
          spinner.stop();
          $('#foo').css('display','none');
          window.location.reload();
        }
      }
    });
    return false;
  });

  $('#contact_form').submit(function(){
    $('#foo').css('display','block');
    var spinner = new Spinner(opts).spin(target);
    $(this).ajaxSubmit({
      success: function(data){
        if(data != true){
          $('#messages').html(data);
          $('#messages').hide().slideDown("slow");
          $("#messages").delay(2500).slideUp(800, function(){
              spinner.stop();
              $('#foo').css('display','none');
              $("#messages").html("");
          });
        }else{
          data = "Tu información ha sido enviada correctamente. <br />Serás contactado a la brevedad.";
          $('#messages').css({'background-color':'#0090C7', 'color':'#ffffff'});
          $('#messages').html(data);
          $('#messages').hide().slideDown("slow");
          $("#messages").delay(3500).slideUp(800, function(){
              spinner.stop();
              $('#foo').css('display','none');
              $("#messages").html("");
              window.location.reload();
          });
        }
      }
    });
    return false;
  });

  $('#newsletter_form').submit(function(){
    $('#foo').css('display','block');
    var spinner = new Spinner(opts).spin(target);
    $(this).ajaxSubmit({
      success: function(data){
        if(data != true){
          $('#messages').html(data);
          $('#messages').hide().slideDown("slow");
          $("#messages").delay(2500).slideUp(800, function(){
              spinner.stop();
              $('#foo').css('display','none');
              $("#messages").html("");
          });
        }else{
          data = "Gracias por suscribirte a nuestro newsletter.";
          $('#messages').css({'background-color':'#0090C7', 'color':'#ffffff'});
          $('#messages').html(data);
          $('#messages').hide().slideDown("slow");
          $("#messages").delay(3500).slideUp(800, function(){
              spinner.stop();
              $('#foo').css('display','none');
              $("#messages").html("");
              window.location.reload();
          });
        }
      }
    });
    return false;
  });

  $('#newsletter_form_footer').submit(function(){
    $('#foo').css('display','block');
    var spinner = new Spinner(opts).spin(target);
    $(this).ajaxSubmit({
      success: function(data){
        if(data != true){
          $('#messages').html(data);
          $('#messages').hide().slideDown("slow");
          $("#messages").delay(2500).slideUp(800, function(){
              spinner.stop();
              $('#foo').css('display','none');
              $("#messages").html("");
          });
        }else{
          data = "Gracias por suscribirte a nuestro newsletter.";
          $('#messages').css({'background-color':'#0090C7', 'color':'#ffffff'});
          $('#messages').html(data);
          $('#messages').hide().slideDown("slow");
          $("#messages").delay(3500).slideUp(800, function(){
              spinner.stop();
              $('#foo').css('display','none');
              $("#messages").html("");
              window.location.reload();
          });
        }
      }
    });
    return false;
  });

  $('#form_catalogo').submit(function(){
    $('#foo').css('display','block');
    var spinner = new Spinner(opts).spin(target);
    $(this).ajaxSubmit({
      success: function(data){
        if(data != true){
          $('#messages').html(data);
          $('#messages').hide().slideDown("slow");
          $("#messages").delay(2500).slideUp(800, function(){
              spinner.stop();
              $('#foo').css('display','none');
              $("#messages").html("");
          });
        }else{
          data = "Gracias, en breve serás contactad@.";
          $('#messages').css({'background-color':'#0090C7', 'color':'#ffffff'});
          $('#messages').html(data);
          $('#messages').hide().slideDown("slow");
          $("#messages").delay(5500).slideUp(800, function(){
              spinner.stop();
              $('#foo').css('display','none');
              $("#messages").html("");
              window.location.reload();
          });
        }
      }
    });
    return false;
  });

  $(".accordion").accordion({
      header: "> h3",
      heightStyle: "content",
      active: false,
      collapsible: true
  });

  $('#img_producto').imageLens({
      imageSrc: $("#img_producto").attr("data-big"),
      lensSize: 130
  });

  $('a.gallery').colorbox({rel:"gallery"});
});

function confirmarCompra(opts, target){
  $('#foo').css('display','block');
  var spinner = new Spinner(opts).spin(target);
  $.post('confirmar_compra', function(data){
    spinner.stop();
    $('#foo').css('display','none');
    if(data != false){
      $.colorbox({html:data, height: "620px"});
      $('#formulario_pedido').submit(function(){
        $('#foo').css('display','block');
        var spinner = new Spinner(opts).spin(target);
        $(this).ajaxSubmit({
          success: function(data){
            if(data != true){
              $('#messages').html(data);
              $('#messages').hide().slideDown("slow");
              $("#messages").delay(2500).slideUp(800, function(){
                  spinner.stop();
                  $('#foo').css('display','none');
                  $("#messages").html("");
              });
            }else{
              data = "<span class='success'>Tu pedido ha sido enviado correctamente. <br />Serás contactado a la brevedad.</span>";
              $('#messages').css({'background-color':'#83bc37'});
              $('#messages').html(data);
              $('#messages').hide().slideDown("slow");
              $("#messages").delay(3500).slideUp(800, function(){
                  spinner.stop();
                  $('#foo').css('display','none');
                  $("#messages").html("");
                  window.location.reload();
              });
            }
          }
        });
        return false;
      });
    }else{
      data = "<span class='error'>Es necesario agregar productos al carrito.</span>";
      $('#messages').html(data);
      $('#messages').hide().slideDown("slow");
      $("#messages").delay(2500).slideUp(800, function(){
          spinner.stop();
          $('#foo').css('display','none');
          $("#messages").html("");
      });
    } 
  });
  return false;
}

function showcarbutton(sku){
  var boton_activo = $('#producto_'+sku).attr('class');
  if(boton_activo == "producto"){
    $('#producto_'+sku).animate(100);
    $('span#producto_'+sku).addClass('boton_activo');
    $('#producto_'+sku+' .botonadd').show("fast");
  }else{
    $('span#producto_'+sku).removeClass('boton_activo');
    $('#producto_'+sku).animate(100);
    $('#producto_'+sku+' .botonadd').hide("fast");
  }
  return false;
}

function tipoEnvio(){
  var envio = $('#tipo_envio input[type="radio"]:checked').val();
  switch(envio){
    case '1':
      $('#informacion_envio_domicilio').html("");
      break;

    case '2':
      $.post("datos-envio", function(data){
        $('#informacion_envio_domicilio').html(data);
      });
      break;
  }
  return false;
}

function addToCar(opts, target){
  $('#foo').css('display','block');
  var spinner = new Spinner(opts).spin(target);
  var form = $('form#descripcion_venta');
   $.ajax({
    url: form.attr('action'),
    type: 'post',
    data: form.serialize(),
    success: function(data){
      if(data != true){
        $('#messages').html(data);
        $('#messages').hide().slideDown("slow");
        $("#messages").delay(1500).slideUp(800, function(){
            spinner.stop();
            $('#foo').css('display','none');
            $("#messages").html("");
        });
      }else{
        data = "<span class='success'>El producto se ha agregado al carrito.</span>";
        $('#messages').css({'background-color':'#0090C7', 'color':'#ffffff'});
        $('#messages').html(data);
        $('#messages').hide().slideDown("slow");
        $("#messages").delay(1500).slideUp(800, function(){
            spinner.stop();
            $('#foo').css('display','none');
            $("#messages").html("");
            window.location.reload();
        });
      }
    }
  });
}

function vaciarCarrito(opts, target){
  $('#foo').css('display','block');
  var spinner = new Spinner(opts).spin(target);
  $.post('vaciar_carrito', function(data){
    if(data != true){
      $('#messages').html(data);
      $('#messages').hide().slideDown("slow");
      $("#messages").delay(1500).slideUp(800, function(){
          spinner.stop();
          $('#foo').css('display','none');
          $("#messages").html("");
      });
    }else{
      data = "<span class='success'>El carrito ha sido vaciado correctamente.</span>";
      $('#messages').css({'background-color':'#0090C7', 'color':'#ffffff'});
      $('#messages').html(data);
      $('#messages').hide().slideDown("slow");
      $("#messages").delay(1500).slideUp(800, function(){
          spinner.stop();
          $('#foo').css('display','none');
          $("#messages").html("");
          window.location.reload();
      });
    }
  });
}