 <fieldset class="fieldset" id="documentacao">
                <input type="text" id='idSolicitacaoHidden' />

                <legend>
                    <h4 id="">Documentação Necessária para Solicitação</h4>
                </legend>
                <div class=" grid-x grid-padding-x">
                    <div class="small-12 large-12 cell" id="arquivosInseriveis" style="width: 100%;">


                    </div>
                </div>

                <div class=" grid-x grid-padding-x" id="arquivosAnexosSucesso">
                    <div class="small-12 large-12 cell" style="width: 100%; padding-top: 30px;">
                        <center><a class="button success " onclick=" $('#envioAssinatura').show();  
                         verificarAssinatura($('#idSolicitacaoHidden').val())  ;    
                         qrCodeAssinatura('https:\/\/agendafacil.guarulhos.sp.gov.br\/maisDigital\/assinatura.php?idSolicitacao='+$('#idSolicitacaoHidden').val());
                          $('#documentacao').hide(); $('#fieldSolicitacao').hide();
                           $('#escolha').css('color', 'rgba(8, 124, 4, 0.66)' );
                            $('#complemento').css('color', 'rgba(8, 124, 4, 0.66)' ); 
                            $('#docsEstagio').css('color', 'rgba(8, 124, 4, 0.66)' );" style="  width: 100%; font-size: 1.3em; border-radius: 10px; "> Clique aqui para fazer a assinatura da Solicitação</a></center>

                    </div>
                </div>
            </fieldset>