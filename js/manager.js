$(document).ready(function(){
  var opts = {
    lines: 13, // The number of lines to draw
    length: 20, // The length of each line
    width: 10, // The line thickness
    radius: 30, // The radius of the inner circle
    corners: 1, // Corner roundness (0..1)
    rotate: 0, // The rotation offset
    direction: 1, // 1: clockwise, -1: counterclockwise
    color: '#007698', // #rgb or #rrggbb or array of colors
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

  $('#login_form').submit(function(e){
    e.preventDefault();
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

  $('#addcategory_form').submit(function(){
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
          data = "<span class='success'>La categoría se ha agregado satisfactoriamente.</span>";
          $('#messages').css({'background-color':'#83bc37'});
          $('#messages').html(data);
          $('#messages').hide().slideDown("slow");
          $("#messages").delay(2500).slideUp(800, function(){
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

  $('#addproduct_form').submit(function(){
    $('#foo').css('display','block');
    var spinner = new Spinner(opts).spin(target);
    $(this).ajaxSubmit({
      beforeSerialize: function(){
        $('#descripcion_producto').val(tinyMCE.get('descripcion_producto').getContent());
      },
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
          data = "<span class='success'>El producto se ha agregado satisfactoriamente.</span>";
          $('#messages').css({'background-color':'#83bc37'});
          $('#messages').html(data);
          $('#messages').hide().slideDown("slow");
          $("#messages").delay(2500).slideUp(800, function(){
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

  $('#editproduct_form').submit(function(){
    $('#foo').css('display','block');
    var spinner = new Spinner(opts).spin(target);
    $(this).ajaxSubmit({
      beforeSerialize: function(){
        $('#descripcion_producto').val(tinyMCE.get('descripcion_producto').getContent());
      },
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
          data = "<span class='success'>El producto se editó satisfactoriamente.</span>";
          $('#messages').css({'background-color':'#83bc37'});
          $('#messages').html(data);
          $('#messages').hide().slideDown("slow");
          $("#messages").delay(2500).slideUp(800, function(){
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

  $('#editcategory_form').submit(function(){
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
          data = "<span class='success'>La categoría se editó satisfactoriamente.</span>";
          $('#messages').css({'background-color':'#83bc37'});
          $('#messages').html(data);
          $('#messages').hide().slideDown("slow");
          $("#messages").delay(2500).slideUp(800, function(){
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

  $('#editcolor_form').submit(function(){
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
          data = "<span class='success'>El color se editó satisfactoriamente.</span>";
          $('#messages').css({'background-color':'#83bc37'});
          $('#messages').html(data);
          $('#messages').hide().slideDown("slow");
          $("#messages").delay(2500).slideUp(800, function(){
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

  $('#editbanner_form').submit(function(){
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
          data = "<span class='success'>El banner se ha editado satisfactoriamente.</span>";
          $('#messages').css({'background-color':'#83bc37'});
          $('#messages').html(data);
          $('#messages').hide().slideDown("slow");
          $("#messages").delay(2500).slideUp(800, function(){
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

  $('#addbanner_form').submit(function(){
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
          data = "<span class='success'>El banner se ha agregado satisfactoriamente.</span>";
          $('#messages').css({'background-color':'#83bc37'});
          $('#messages').html(data);
          $('#messages').hide().slideDown("slow");
          $("#messages").delay(2500).slideUp(800, function(){
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

  $('#addcolor_form').submit(function(){
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
          data = "<span class='success'>El color se ha editado satisfactoriamente.</span>";
          $('#messages').css({'background-color':'#83bc37'});
          $('#messages').html(data);
          $('#messages').hide().slideDown("slow");
          $("#messages").delay(2500).slideUp(800, function(){
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

  $('#agregar_color').click(function(){
    $('#lista_colores option:selected').appendTo($('#colores_seleccionados'));
    return false;
  });

  $('#quitar_color').click(function(){
    $('#colores_seleccionados option:selected').appendTo($('#lista_colores'));
    return false;
  });

  $('#hex_color').ColorPicker({
    color: '#ffffff',
    onShow: function(colpkr){
      $(colpkr).fadeIn(500);
      return false;
    },
    onHide: function(colpkr){
      $(colpkr).fadeOut(500);
      return false;
    },
    onChange: function(hsb, hex, rgb){
      $('#hex_color').val(hex);
      $('#hex_color').css('backgroundColor', '#' + hex);
    }
  });
});

function addmodel(){
  var num = $('#modelos .model-content').length;
  var max_model = 30;

  num = num + 1;
  if(num <= max_model){
    $('#modelos').append('<span class="model-content" id="model_'+num+'"><label for="modelo_id">Número de modelo </label><input type="text" name="num_modelo[]" placeholder="Número de modelo"><label for="desc_modelo">Descripción del modelo </label><input type="text" name="desc_modelo[]" placeholder="Descripción del modelo"><input type="file" name="modelo_img[]" ><a class="ui-icon ui-icon-circle-minus" onclick="removemodel('+num+');"></a></span>');
  }
  return false;
}

function removemodel(content){
  var min_model = 0;
  $('#model_'+content).remove();
  return false;
}

function activar_banner(b_id, status, opts, target){
  $('#foo').css('display','block');
  var spinner = new Spinner(opts).spin(target);
  $.ajax({
    url: 'http://iniciativatextil.com/manager/activar_banner',
    type: 'post',
    data: {
      banner_id: b_id,
      status_banner: status
    },
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
        data = "<span class='success'>La acción se ha realizado satisfactoriamente.</span>";
        $('#messages').css({'background-color':'#83bc37'});
        $('#messages').html(data);
        $('#messages').hide().slideDown("slow");
        $("#messages").delay(2500).slideUp(800, function(){
          spinner.stop();
          $('#foo').css('display','none');
          $("#messages").html("");
          window.location.reload();
        });
      }
    }
  });
}

function activar_categoria(cid, status, opts, target){
  $('#foo').css('display','block');
  var spinner = new Spinner(opts).spin(target);
  $.ajax({
    url: 'http://iniciativatextil.com/manager/activar_categoria',
    type: 'post',
    data: {
      category_id: cid,
      status_category: status
    },
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
        data = "<span class='success'>La acción se ha realizado satisfactoriamente.</span>";
        $('#messages').css({'background-color':'#83bc37'});
        $('#messages').html(data);
        $('#messages').hide().slideDown("slow");
        $("#messages").delay(2500).slideUp(800, function(){
            spinner.stop();
            $('#foo').css('display','none');
            $("#messages").html("");
            window.location.reload();
        });
      }
    }
  });
}

function borrar_banner(b_id, hash, opts, target){
  $('#foo').css('display','block');
  var spinner = new Spinner(opts).spin(target);
  $.ajax({
    url: 'http://iniciativatextil.com/manager/borrar_banner',
    type: 'post',
    data: {
      buid: b_id,
      hash: hash
    },
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
        data = "<span class='success'>La acción se ha realizado satisfactoriamente.</span>";
        $('#messages').css({'background-color':'#83bc37'});
        $('#messages').html(data);
        $('#messages').hide().slideDown("slow");
        $("#messages").delay(2500).slideUp(800, function(){
            spinner.stop();
            $('#foo').css('display','none');
            $("#messages").html("");
            window.location.reload();
        });
      }
    }
  });
}

function borrar_producto(puid, hash, url, opts, target){
  $('#foo').css('display','block');
  var spinner = new Spinner(opts).spin(target);
  $.ajax({
    url: url,
    type: 'post',
    data: {
      puid: puid,
      hash: hash
    },
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
        data = "<span class='success'>La acción se ha realizado satisfactoriamente.</span>";
        $('#messages').css({'background-color':'#83bc37'});
        $('#messages').html(data);
        $('#messages').hide().slideDown("slow");
        $("#messages").delay(2500).slideUp(800, function(){
            spinner.stop();
            $('#foo').css('display','none');
            $("#messages").html("");
            window.location.reload();
        });
      }
    }
  });
}

function borrar_categoria(cid, hash, url, opts, target){
  console.log(cid);
  console.log(hash);
  console.log(url);
  $('#foo').css('display','block');
  var spinner = new Spinner(opts).spin(target);
  $.ajax({
    url: url,
    type: 'post',
    data: {
      cid: cid,
      hash: hash
    },
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
        data = "<span class='success'>La acción se ha realizado satisfactoriamente.</span>";
        $('#messages').css({'background-color':'#83bc37'});
        $('#messages').html(data);
        $('#messages').hide().slideDown("slow");
        $("#messages").delay(2500).slideUp(800, function(){
          spinner.stop();
          $('#foo').css('display','none');
          $("#messages").html("");
          window.location.reload();
        });
      }
    }
  });
}

function borrar_color(cuid, hash, opts, target){
  $('#foo').css('display','block');
  var spinner = new Spinner(opts).spin(target);
  $.ajax({
    url: 'http://iniciativatextil.com/manager/borrar_color',
    type: 'post',
    data: {
      cuid: cuid,
      hash: hash
    },
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
        data = "<span class='success'>La acción se ha realizado satisfactoriamente.</span>";
        $('#messages').css({'background-color':'#83bc37'});
        $('#messages').html(data);
        $('#messages').hide().slideDown("slow");
        $("#messages").delay(2500).slideUp(800, function(){
            spinner.stop();
            $('#foo').css('display','none');
            $("#messages").html("");
            window.location.reload();
        });
      }
    }
  });
}

function publicarProducto(puid, status, opts, target){
  $('#foo').css('display','block');
  var spinner = new Spinner(opts).spin(target);
  $.ajax({
    url: 'http://iniciativatextil.com/manager/activar_producto',
    type: 'post',
    data: {
      product_uid: puid,
      status_producto: status
    },
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
        data = "<span class='success'>La acción se ha realizado satisfactoriamente.</span>";
        $('#messages').css({'background-color':'#83bc37'});
        $('#messages').html(data);
        $('#messages').hide().slideDown("slow");
        $("#messages").delay(2500).slideUp(800, function(){
            spinner.stop();
            $('#foo').css('display','none');
            $("#messages").html("");
            window.location.reload();
        });
      }
    }
  });
}