<?php $this->load->view('site/header'); ?>
        <div class="col-md-12 banncarrusel">
                <div id="slideshow">                            
                    <img border="0" src="<?php echo base_url(); ?>img/it_catalogo_fisico.png" width="100%" />
                </div>
            </div>
            <div class="container gnral">
                <h2>Solicita tu catálogo físico</h2>
                <div class="col-md-12">
                <div class="col-md-6">   
                        <span id="texto"><p>Contamos con varias categorías, cada catálogo tiene un precio de $50</p>
                        <p>Selecciona los de tu preferencia, llena el formulario y nos comunicaremos a la brevedad para confirmar el pedido y realizar el envío.</p>
                        <?php $attr = array('id'=>'form_catalogo','name'=>'form_catalogo','method'=>'POST','autocomplete'=>'off'); ?>
                        <?php echo form_open('solicitar-catalogo', $attr); ?>
                        <span class="bloque_formulario">
                            <label for="">* Nombre(s): </label>
                            <input type="text" placeholder="Nombre(s)" name="inpt_catalogo_nombre" id="inpt_catalogo_nombre">
                        </span>
                        <span class="bloque_formulario">
                            <label for="">* Apellidos: </label>
                            <input type="text" placeholder="Apellidos" name="inpt_catalogo_apellidos" id="inpt_catalogo_apellidos">
                        </span>
                        <span class="bloque_formulario">
                            <label for="">* E-mail: </label>
                            <input type="text" placeholder="E-mail" name="inpt_catalogo_email" id="inpt_catalogo_email">
                        </span>
                        <span class="bloque_formulario">
                            <label for="">* Teléfono: </label>
                            <input type="text" placeholder="Teléfono" name="inpt_catalogo_telefono" id="inpt_catalogo_telefono">
                        </span>
                        <span class="bloque_formulario">
                            <label for="">* Dirección: </label>
                            <input type="text" placeholder="Dirección" name="inpt_catalogo_direccion" id="inpt_catalogo_direccion">
                        </span>
                    </div>
                    <div class="col-md-6">
                        <span class="bloque_formulario blc-long">
                            <h3 style="margin-top:0px !important">Selecciona los catálogos de tu preferencia: </h3>
                            <span class="opciones-check">
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-Acolchado-chamarra">
                                    <p>Acolchado chamarra</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-Ambassador">
                                    <p>Ambassador</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-Atenas">
                                    <p>Atenas</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-borus">
                                    <p>Borus</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-bramante-hospital">
                                    <p>Bramante Hospital</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-bramante-huatulco">
                                    <p>Bramante Huatulco</p>
                                </span>                          
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-canada">
                                    <p>Canada</p>
                                </span>
                                 <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-chanel">
                                    <p>Chanel</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-capricho">
                                    <p>Capricho</p>
                                </span>                               
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-corsa-repelente">
                                    <p>Corsa Repelente</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-Mil-rayas">
                                    <p>Mil rayas</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-Escoces-lanera">
                                    <p>Escocés lanera</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-Escoces-la-luz">
                                    <p>Escocés la luz</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-Escoces-Xalostoc">
                                    <p>Escocés Xalostoc</p>
                                </span>                               
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-gabardina-lincoln">
                                    <p>Gabardina Lincoln</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-gabardina-cambridge">
                                    <p>Gabardina Cambridge</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-gabardina-conquerer">
                                    <p>Gabardina Conquerer</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-gabardina-liverpool">
                                    <p>Gabardina Liverpool</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-gabardina-lancaster">
                                    <p>Gabardina Lancaster</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-gabardina-london">
                                    <p>Gabardina London</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-gabardina-uniforme">
                                    <p>Gabardina Uniforme</p>
                                </span>                               
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-Gran-Brillante">
                                    <p>Gran Brillante</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-hawai">
                                    <p>Hawai</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-indiolino">
                                    <p>Indiolino</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-jamaica">
                                    <p>Jamaica</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-kurowawa">
                                    <p>Kurosawa</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-lino-italia">
                                    <p>Lino Italia</p>
                                </span>                            
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-mezclilla-5onz">
                                    <p>Mezclilla 5 onz</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-mezclilla-9onz">
                                    <p>Mezclilla 9 onz</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-mezclilla-10.5">
                                    <p>Mezclilla 10.5</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-mezclilla-12">
                                    <p>Mezclilla 12</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-mezclilla-6.5">
                                    <p>Mezclilla 6.5</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-mezclilla-7.5">
                                    <p>Mezclilla 7.5</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-mezclilla-14.75">
                                    <p>Mezclilla 14.75</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-mezclilla-13.75">
                                    <p>Mezclilla 13.75</p>
                                </span>                                                               
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-oxford">
                                    <p>Oxford</p>
                                </span>                                
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-paladin">
                                    <p>Paladin</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-pano">
                                    <p>Paño</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-Pata-de-Gallo">
                                    <p>Pata de Gallo</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-Premium">
                                    <p>Premium</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-Popelin">
                                    <p>Popelin</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-Rib-Stop">
                                    <p>Rib Stop</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-rib-stop-camuflaje">
                                    <p>Rib Stop Camuflaje</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-rib-stop-repelente">
                                    <p>Rib Stop Repelente</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-royalty">
                                    <p>Royalty</p>
                                </span>          
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-supremo">
                                    <p>Supremo</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-tampa">
                                    <p>Tampa</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-tergal-catalan">
                                    <p>Tergal Catalan</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-Premium">
                                    <p>Tergal Premium</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-Termoflu">
                                    <p>Termoflu</p>
                                </span>                
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-villela-love">
                                    <p>Villela Love</p>
                                </span>
                                <span class="opciones-bloque">
                                    <input type="checkbox" name="catalogo_fisico[]" value="catalogo-pin-point">
                                    <p>Pin Point</p>
                                </span>
                            </span>
                        </span>
                    </div>
                    <div class="col-md-12">
                        <span class="bloque_formulario form-promociones">
                            <input type="checkbox" value="1" name="recibir_promociones"><label for="">Acepto recibir promociones y noticias</label>
                        </span>
                        <span class="bloque_formulario form-submit">
                            <input type="submit" value="Pedir" class="input-flat-lng">
                        </span></span>
                        <?php echo form_close(); ?>
                    </div>
                    </div>
                </div>
            </div>
       
<?php $this->load->view('site/footer'); ?>