<?php

return array (

'user' => [
   'incorrect_password' => 'Senha incorreta',
   'incorrect_old_password' => 'Senha antiga incorreta',
   'change_password' => 'Necessário é a nova senha deve não seja igual à senha antiga',
   'password_updated' => 'Senha atualizada',
   'location_updated' => 'Localização atualizada',
   'language_updated' => 'Idioma atualizado',
   'profile_updated' => 'Perfil atualizado',
   'user_not_found' => 'Usuário não encontrado',
   'not_paid' => 'Usuário não pagou',
   'referral_amount' => 'Valor da referência',
   'referral_count' => 'Contagem de referências',
   'invite_friends' => '<p style=\"color:#FDFEFE;\">Consulte seus'.config('constants.referral_count', '0'). 'amigos<br>e ganhe <span style=\"color: #f06292\">'. config('constants.currency','').' '. config('constants.referral_amount','0').'</span> por pessoa</p>',
   'logged_in' => 'Logado com sucesso',
   'logged_out' => 'Deslogado com sucesso',
   'inserted' => 'Inserido com sucesso',
   'updated' => 'Atualizado com sucesso',
],

'provider' => [
   'incorrect_password' => 'Senha incorreta',
   'incorrect_old_password' => 'Senha antiga incorreta',
   'change_password' => 'Necessário é a nova senha deve não seja igual à senha antiga',
   'password_updated' => 'Senha atualizada',
   'location_updated' => 'Localização atualizada',
   'language_updated' => 'Idioma atualizado',
   'profile_updated' => 'Perfil atualizado',
   'provider_not_found' => 'Fornecedor não encontrado',
   'not_approved' => 'Sua conta não foi aprovada para dirigir',	
   'incorrect_email' => 'O endereço de e-mail ou a senha digitados estão incorretos',
   'referral_amount' => 'Valor da referência',
   'referral_count' => 'Contagem de referências',
   'invite_friends' => '<p style=\"color:#FDFEFE;\">Consulte seus' .config('constants.referral_count', '0'). 'amigos<br> e ganhe <span style=\"color:#f06292\">'. config(' constants.currency ',' ').' '. config('constants.referral_amount',' 0 ').' </span> por cabeça </p>',
],

'ride' => [
   'request_inprogress' => 'Solicitação já aceita',
   'no_providers_found' => 'Nenhum Motorista encontrado',
   'request_cancelled' => 'Sua viagem foi cancelada',
   'already_cancelled' => 'Já foi cancelada',
   'ride_cancelled' => 'Viagem cancelada',
   'already_onride' => 'Você já está em uma corrida',
   'provider_rated' => 'Motorista avaliado',
   'request_scheduled' => 'Corrida agendada',
   'request_already_scheduled' => 'Corrida já agendado',
   'request_modify_location' => 'Endereço de destino alterado pelo Passageiro',
   'request_completed' => 'Solicitação concluída',
   'request_not_completed' => 'Solicitação ainda não concluída',
   'request_rejected' => 'Solicitação rejeitada com sucesso',
   'no_service_found' => 'Nenhum Serviço encontrado',
   'payment_updated' => 'Pagamento atualizado',
   'request_rejected' => 'Corrida rejeitada',
   'request_accepted' => 'Sua Corrida foi aceita',
   'schedule_request_created' => 'Nova Corridas agendada',
   'new_request_created' => 'Nova Corridas solicitada',
],

'service' => [
   'already_cancelled' => 'Serviço já cancelado',
   'request_inprogress' => 'Solicitação já em andamento',
   'request_rejected' => 'Solicitação rejeitada com sucesso',
   'ride_cancelled' => 'Serviço cancelado',
   'request_completed' => 'Solicitação concluída',
   'request_not_completed' => 'Solicitação ainda não concluída',
   'service_rated' => 'Serviço avaliado',
   'payment_updated' => 'Pagamento atualizado',
   'request_rejected' => 'Serviço rejeitado',
   'request_accepted' => 'Seu serviço foi aceito',
],

'order' => [
   'request_inprogress' => 'Solicitação já em andamento',
   'request_rejected' => 'Solicitação rejeitada com sucesso',
   'ride_cancelled' => 'Pedido cancelado',
   'request_completed' => 'Solicitação concluída',
   'request_not_completed' => 'Solicitação ainda não concluída',
   'service_rated' => 'Pedido classificado com êxito',
   'payment_updated' => 'Pagamento atualizado',
   'Cancelled' => 'O Estabelecimento cancelou seu pedido',
   'something_went_wront' => 'Algo deu errado',
   'request_rejected' => 'Pedido rejeitado',
   'request_accepted' => 'Seu pedido aceito',
],

'payment_success' => 'Pagamento bem-sucedido',
'invalid' => 'Credenciais inválidas',
'unauthenticated' => 'Não autenticado',
'something_went_wrong' => 'Algo deu errado',
'destination_changed' => 'Local de destino alterado',
'unable_accept' => 'Não foi possível aceitar, tente novamente mais tarde',
'connection_err' => 'Erro de conexão',
'logout_success' => 'Desconectado com êxito',
'email_available' => 'Email disponível',
'email_not_available' => 'Email não disponível',
'mobile_exist' => 'Número de celular já existe',
'country_code' => 'O código do país é obrigatório.',
'email_exist' => 'O email já existe',
'available' => 'Dados disponíveis',
'services_not_found' => 'Serviços não encontrados',
'promocode_applied' => 'Promocode aplicado',
'promocode_expired' => 'Promocode expirado',
'promocode_already_in_use' => 'Promocode já em uso',
'paid' => 'Pago',
'amount_added_to_your_wallet' => 'Valor adicionado à sua carteira',
'added_to_your_wallet' => 'Adicionado à sua carteira',
'amount_success' => 'Valor da solicitação adicionado',
'amount_cancel' => 'Pedido foi cancelado',
'amount_max' => 'O valor não pode ser maior que',
'card_already' => 'Cartão já adicionado',
'card_added' => 'Cartão adicionado',
'card_deleted' => 'Cartão excluído',
'otp' => 'Otp está errado',
'add_card_required' => 'Nenhum cartão disponível! Adicione seu cartão em seu perfil',
'account_disabled' => 'Conta Desabilitada ou Excluída',
'push' => [
   'request_accepted' => 'Sua solicitação foi aceita por um Motorista',
   'service_accepted' => 'Seu serviço foi aceito por um Provedor',
   'order_accepted' => 'Seu pedido aceito por um Entregador',
   'request_assign' => 'O administrador atribuiu um pedido',
   'arrived' => 'O Motorista chegou ao seu local',
   'reached' => 'O Entregador chegou à loja',
   'pickedup' => 'Corrida iniciada',
   'complete' => 'Corrida concluída',
   'rate' => 'Avaliado com sucesso',
   'dropped' => 'Sua viagem foi concluída com sucesso. você tem que pagar',
   'incoming_request' => 'Nova solicitação',
   'chat_message' => 'Nova mensagem recebida',
   'added_money_to_wallet' => 'Adicionado à sua carteira',
   'charged_from_wallet' => 'Cobrado da sua carteira',
   'document_verfied' => 'Seus documentos foram verificados, agora você está pronto para iniciar seu negócio',
   'provider_not_available' => 'Desculpe pelo inconveniente, nossos parceiros estão ocupados. Por favor, tente depois de algum tempo',
   'user_cancelled' => 'Usuário cancelou a corrida',
   'provider_cancelled' => 'O Motorista cancelou a corrida',
   'schedule_start' => 'O percurso da sua corrida foi iniciado',
   'provider_waiting_start' => 'O Motorista iniciou o tempo de espera',
   'provider_waiting_end' => 'O Motorista parou o tempo de espera',
   'provider_status_hold' => 'Fique off-line se quiser descansar',
],

'service' => [
   'incoming_request' => 'Nova solicitação de Serviço',
   'provider_not_available' => 'Desculpe pelo inconveniente, nossos parceiros estão ocupados. Por favor, tente depois de algum tempo',
   'arrived' => 'O Provedor chegou ao seu local',
   'pickedup' => 'Serviço iniciado',
   'complete' => 'Serviço concluído',
   'dropped' => 'Seu serviço foi concluído com sucesso. você tem que pagar',
   'confirmpay' => 'Pagamento confirmado',
],

'order' => [
   'incoming_request' => 'Nova solicitação de Entrega',
   'provider_not_available' => 'Desculpe pelo inconveniente, nossos parceiros estão ocupados. Por favor, tente depois de algum tempo',
   'started' => 'O Entregador começou a ir à loja',
   'reached' => 'O Entregador chegou à loja',
   'arrived' => 'O Entregador chegou ao seu local',
   'pickedup' => 'Pedido recolhido',
   'complete' => 'Pedido concluído',
   'verified' => 'Código validado com sucesso',
   'dropped' => 'Seu serviço foi concluído com sucesso. você tem que pagar',
   'confirmpay' => 'Pagamento confirmado',
   'already_completed' => 'Pedido já concluído',
],

'transaction' => [
   'admin_commission' => 'comissão do administrador',
   'fleet_debit' => 'comissão da Frota debitada',
   'fleet_add' => 'comissão da Frota adicionada',
   'fleet_recharge' => 'recarga de comissão da Frota',
   'discount_apply' => 'desconto aplicado',
   'discount_refund' => 'reembolso do valor do desconto',
   'discount_recharge' => 'recarga do valor do desconto do provedor',
   'tax_credit' => 'valor do imposto creditado',
   'tax_debit' => 'valor do imposto debitado',	
   'provider_credit' => 'valor da viagem adicionado',	
   'provider_recharge' => 'recarga do valor do passeio do provedor',	
   'user_recharge' => 'recarga',	
   'user_trip' => 'viagem',
   'referal_recharge' => 'Recarga de referência',
   'dispute_refund' => 'Reembolso de disputa',
   'peak_commission' => 'Comissão das horas de ponta',
   'waiting_commission' => 'Comissão de cobranças em espera',
]

);