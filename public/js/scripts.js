/*!
    * Start Bootstrap - SB Admin v6.0.2 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    (function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
            if (this.href === path) {
                $(this).addClass("active");
            }
        });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });

	var base_url = $('.navbar-brand').attr('href');

    $(".cpf-mask").mask("000.000.000-00");
    $(".cns-mask").mask("000000000000000");
    $(".cep-mask").mask("00000-000");

    $('.consulta-cep').on('keyup',function(){

		var cep = $(this).val();
		cep = cep.replace('-', '');
		cep = cep.replace(/_/g, ' ');
		cep = cep.trim();

		if ( cep.length == 8 ){

			$.ajax({
				type: "GET",
				url: 'https://viacep.com.br/ws/'+cep+'/json/',
				async: false,
				dataType : "HTML",
				success: function(status){
					
					//alert(status);
						
				},complete: function(resp){
					
					var IS_JSON = true;
					
					try
					{
						var resp_json = $.parseJSON(resp.responseText);
					}
					catch(err)
					{
						IS_JSON = false;
					}
					
					if ( IS_JSON ){
						
						resp = resp_json;
						
						if (!resp.erro) {

							var logradouro = $('input[name="logradouro"]');
							var estado = $('input[name="estado"]');
                            var bairro = $('input[name="bairro"]');
                            var uf = $('input[name="uf"]');

							logradouro.val(resp.logradouro);
							estado.val(resp.localidade);
                            bairro.val(resp.bairro);
                            uf.val(resp.uf);

						} else {

							alert('CEP não encontrado');
							$('input[name="logradouro"]').val("");
                            $('input[name="estado"]').val("");
                            $('input[name="bairro"]').val("");
                            $('input[name="uf"]').val("");
						}
					}
				},
				error: function(){
					alert('Ajax request failed. (cep)');
				}
			});
		}
    });
	
 
	if ($('input[type=file]').length) {

		$(document).on('change','input[type=file]',function() {	   

			var uuid = $("input[name='paciente_uuid']").val();
			var data = {uuid:uuid};

			$(this).simpleUpload(base_url+"paciente/adicionar_imagem", {
	   
				data: data,

				start: function(file){
					//upload started
					//$('#filename').html(file.name);
					//$('#progress').html("");
					$('#progressBar').width(0);
				},
				progress: function(progress){
					//received progress
					//$('#progress').html("Progress: " + Math.round(progress) + "%");
					$('#progressBar').width(progress + "%");
				},
				success: function(data){

					var resp = $.parseJSON(data);
						
					if (resp.status == 'error') {
						
						$('.erros-foto-paciente').html(resp.mensagem);
						$('.progress-bar').width('0');

					} else {

						$('.foto-paciente').attr('src','').attr('src',resp.url_foto + '?' + Math.random());
						$('.progress-bar').width('0');
						$('#btn-excluir-foto-paciente').prop("disabled", false);
					}

				},
	   
				error: function(error){
					//upload failed
					$('#progress').html("Failure!<br>" + error.name + ": " + error.message);
				}
	   
			});
	   
		});

	}

	if ($('#btn-excluir-foto-paciente').length) {
	
		$(document).on('click','#btn-excluir-foto-paciente',function(e) {
			
			var uuid = $('input[name="paciente_uuid"]').val();

			if (uuid) {
				
				if (confirm('Deseja realmente excluir?')) {
					
					$.ajax({
						type: "POST",
						url: base_url+'paciente/excluir_imagem',
						data: {uuid:uuid},
						dataType : "JSON",
						success: function(status){

							//alert(status);
							//console.log(status);
								
						},complete: function(resp){

							var IS_JSON = true;
							
							//console.log(resp);
							
							try
							{
								var resp_json = $.parseJSON(resp.responseText);
							}
							catch(err)
							{
								IS_JSON = false;
							}
							
							if ( IS_JSON ){
								
								resp = resp_json;
								
								if (resp.status == 'error'){
									
									alert(resp.mensagem);
									
								} else {

									$('.foto-paciente').attr('src','').attr('src',resp.url_foto + '?' + Math.random());
									$('#btn-excluir-foto-paciente').prop("disabled", true);

								}

							}
							
						}
							
					});
					
					e.preventDefault();
					
				}

			}
			
		});

	}
	   

})(jQuery);
