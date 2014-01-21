<?php
    class contato_Controller extends System_Controller
    {
        /**
         * layout do email de contato
         */
        CONST CONTACT_MAIL_LAYOUT_PATH =  'includes/View/emails/contato.php';
        CONST CONCACT_MAIL_SUBJECT = "Contato de usuário do site.";

        public function index($params)
        {

            if ($params["acao"] == "enviaContato") {
                $data =& $params["contato"];
            }

            $result = 0;
            /**
             * se os dados foram passados, envia o email
             */
            if (!empty($data)) {

                /**
                 * cria o novo contato no banco de dados
                 * @var Reuse_ACK_Model_Contatos
                 */
                $contacts = new Reuse_ACK_Model_Contact;

                $set = array(
                                'remetente'=>$data['nome'],
                                'email'=>$data['email'],
                                'fone'=>$data['telefone'],
                                'mensagem'=>$data['mensagem'],
                                'lido'=>0,
                                'status'=> 1,
                            );
                $result = $contacts->create($set);

                /**
                 * se criou o contato manda o email
                 */
                if ($result) {

                    $result = System_Mail::send($set,
                                        "Contato do site Vanessa Guerra",
                                        "includes/View/emails/contato.php",
                                        $this->config->mail->destinatary,
                                        $set['remetente']
                                    );
                }
                $result = array('status'=>$result,'mensagem'=>($result) ? 'Mensagem Enviada!' : 'Falha no envio.');

            /**
             * se não retorna os dados de endereco
             */
            } else {

                $endereco = new Reuse_ACK_Model_Address;
                $result = $endereco->get();

                /**
                 * pega os dados genéricos da aplicacao
                 * (facebook,twitter)
                 * @var Reuse_ACK_Model_System
                 */
                $system = new Reuse_ACK_Model_System;
                $resultSystem = $system->get();
                $result['facebook'] = $resultSystem[0]['facebook'];
                $result['twitter'] = $resultSystem[0]['twitter'];
                /**
                 * une os dados de contato com os dados do sistema
                 * @var array
                 */
                $result = array_merge($result[0], $resultSystem[0]);
            /**
             * prepara a saída para o padraao do js
             */
                $result["endereco"] = $result["endereco_pt"].", ".$result["bairro_pt"]."</br>".$result["cidade_pt"]." - ".$result["estado_pt"];
                $result["telefone"] = $result["fone_pt"] ;

                if (!empty($result["fone2_pt"])) {
                    $result["telefone"].= " - ".$result["fone2_pt"];
                }

                $result["mapa"] = $result["link_mapa_pt"];
            }

            return $result;
        }
    }
