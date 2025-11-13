       <fieldset class="fieldset" id="fieldSolicitacao">
                <legend>
                    <h4 id=""> </h4>
                </legend>

                <div class=" grid-x  grid-padding-x" style="padding-bottom: 10px;">

                    <div class="small-12 large-2 cell">
                        <label>Nome do Solicitante
                            <input type="text" readonly style="width: 100%;" id="nomeSolicitante" value="<?= $_SESSION['usuariosLogados']['dados'][0]['nome_pessoa'] ?>" />
                        </label>
                    </div>
                    <div class="small-12 large-2 cell">
                        <label>CPF do Solicitante
                            <input type="text" readonly style="width: 100%;" id="cpfSolicitante" value="<?= $_SESSION['usuariosLogados']['cpfDoUsuario'] ?>" />
                        </label>
                    </div>

                    <div class="small-12 large-2 cell">
                        <label>Email do Solicitante
                            <input type="text" readonly style="width: 100%;" id="emailSolicitante" value="<?= $_SESSION['usuariosLogados']['dados'][0]['email_usuario'] ?>" />
                        </label>
                    </div>

                    <div class="small-12 large-2 cell">
                        <label>Dia da Solicitação
                            <input type="text" readonly style="width: 100%;" value="<?php echo date('d/m/Y'); ?>" />
                        </label>

                    </div>

                    <div class="small-12 large-2 cell">
                        <label> Representa outra pessoa?
                            <a class="button" onclick="$('#boxTerceiro').show(); $('#representaTerceiro').val(1)" style="width: 100%;   ">Sim!</a>
                        </label>

                    </div>

                    <div class="small-12 large-2 cell">
                        <label>&nbsp;
                            <a class="button" onclick="$('#boxTerceiro').hide(); $('#representaTerceiro').val(0)" style="width: 100%; background-color: #363636ff;">Não!</a>
                        </label>

                    </div>

                    <div class="small-12 large-12 cell" id="boxTerceiro">
                        <fieldset class="fieldset" style="background-color: #1779ba1c; border-radius: 15px;">
                            <h5><b>Dados do Terceiro</b></h5>

                            <div class=" grid-x  grid-padding-x">

                                <div class="small-12 large-4 cell">
                                    <label>Nome do Terceiro
                                        <input type="hidden" style="width: 100%;" id="representaTerceiro" />
                                        <input type="text" style="width: 100%;" id="nomeTerceiro" />
                                    </label>


                                </div>

                                <div class="small-12 large-3 cell">
                                    <label>CPF ou CNPJ
                                        <input type="text" style="width: 100%;" id="cpfTerceiro" />
                                    </label>


                                </div>

                                <div class="small-12 large-3 cell">
                                    <label>Email
                                        <input type="text" style="width: 100%;" id="emailTerceiro" />
                                    </label>


                                </div>

                                <div class="small-12 large-2 cell">
                                    <label>Telefone
                                        <input type="text" style="width: 100%;" id="telefoneTerceiro" />
                                    </label>


                                </div>


                                <div class="small-12 large-12 cell" style="padding-top: 10px;">
                                    <h6><b>Autorizo para todos os atos desse processo, os(as) senhores(as) </b></h6>

                                    <div class=" grid-x  grid-padding-x atuarPessoa" id="boxPessoas">

                                        <div class="small-12 large-3 cell">
                                            <label>Nome
                                                <input type="text" class="nomeAtuar">
                                            </label>


                                        </div>

                                        <div class="small-12 large-2 cell">
                                            <label>RG
                                                <input type="text" style="width: 100%;" class="rgAtuar" />
                                            </label>


                                        </div>

                                        <div class="small-12 large-3 cell">
                                            <label>Email
                                                <input type="text" style="width: 100%;" class="emailAtuar" />
                                            </label>


                                        </div>

                                        <div class="small-12 large-2 cell">
                                            <label>Celular
                                                <input type="text" style="width: 100%;" class="celularAtuar" />
                                            </label>


                                        </div>

                                        <div class="small-12 large-2 cell">
                                            <label>Adicionar outra Pessoa
                                                <a class="button" onclick="clonarClasse()" style="width: 100%;"> + </a>
                                            </label>


                                        </div>





                                    </div>

                                    <div id="containerClone">

                                    </div>

                                    </label>


                                </div>



                            </div>


                        </fieldset>


                    </div>


                    <div class="small-12 large-12 cell" id=" ">
                        <fieldset class="fieldset">
                            <legend>Informação da Solicitação</legend>

                            <div class=" grid-x  grid-padding-x">

                                <div class="small-12 large-2 cell">
                                    <label>CEP:
                                        <input type="text" id="txtCEP" onchange="chamaCEP($('#txtCEP').val())" style="width: 100%;" />
                                    </label>

                                </div>

                                <div class="small-12 large-3 cell">
                                    <label>Logradouro
                                        <input type="text" id="txtRua" style="width: 100%;" />
                                    </label>

                                </div>

                                <div class="small-12 large-1 cell">
                                    <label>Nº
                                        <input type="text" id="txtNUmero" style="width: 100%;" />
                                    </label>

                                </div>

                                <div class="small-12 large-2 cell">
                                    <label>Complemento
                                        <input type="text" id="txtComplemento" style="width: 100%;" />
                                    </label>

                                </div>

                                <div class="small-12 large-2 cell">
                                    <label>Bairro
                                        <input type="text" id="txtBairro" style="width: 100%;" />
                                    </label>

                                </div>

                                <div class="small-12 large-2 cell">
                                    <label>Cidade / Estado
                                        <input type="text" id="txtCidade" style="width: 100%;" />
                                    </label>

                                </div>


                                <div class="small-12 large-1 cell" style="display: none;">
                                    <label>UF
                                        <input type="text" id="txtEstado" style="width: 100%;" />
                                    </label>

                                </div>


                                <div class="small-12 large-12 cell">
                                    <label>Assunto da Solicitação
                                        <input type="text" readonly style="width: 100%;" id="nomeDoServicoLabel" value="" />
                                    </label>
                                </div>

                                <div class="small-12 large-12 cell">
                                    <label>Descrição da Sua Solicitação <i>(Campo Obrigatório)</i>
                                        <textarea id='txtDescricao' rows="5" style="width: 100%;"></textarea>
                                    </label>
                                </div>

                                <div class="small-12 large-3 cell">
                                    <label>Escolha qual tipo de Inscrição

                                        <script>
                                            criaCombo('comboTipoInscricao');
                                        </script>
                                        <select id="comboTipoInscricao"
                                            onchange="trocaCampo($(this).val())" name="state" style="width: 100%; ">

                                        </select>
                                    </label>
                                </div>

                                <div class="small-12 large-2 cell" id="boxInsc">
                                    <label id="tipoInscricaoLbl">Inscrição Mobiliária </label>
                                    <input id="inscDocu" type="text" style="width: 100%;" />

                                </div>

                                <div class="small-12 large-2 cell">
                                    <label>Status da Solicitação
                                        <input type="text" readonly style="width: 100%;" value="Abertura" />
                                    </label>

                                </div>

                                <div class="small-12 large-5 cell">
                                    <label><br>
                                        <center><a class="button success" style="width: 100%;"
                                                onclick=" inserirSolicitacao('<?= $_SESSION['usuariosLogados']['dados'][0]['id_pessoa'] ?>');">Avançar para a documentação </a>
                                        </center>
                                    </label>
                                </div>
                            </div>
                        </fieldset>


            </fieldset>