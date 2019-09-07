-- CREATING TABLE config
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- INSERTING DATA INTO config
INSERT INTO config VALUES ('1','site_theme','onepage');
INSERT INTO config VALUES ('2','site_name','GeekCMS');
INSERT INTO config VALUES ('3','site_timezone','America/Bahia');
INSERT INTO config VALUES ('4','site_url','http://127.0.0.1/');
INSERT INTO config VALUES ('5','site_dir','geekcms');
INSERT INTO config VALUES ('6','site_slogan','Sistema Gerenciador de Conteúdo');
INSERT INTO config VALUES ('7','site_logo','logo.png');
INSERT INTO config VALUES ('8','site_favicon','favicon.png');
INSERT INTO config VALUES ('9','site_analytics','');
INSERT INTO config VALUES ('10','site_email','hitaloramon@live.com');
INSERT INTO config VALUES ('11','site_mailer','PHP');
INSERT INTO config VALUES ('12','smtp_host','');
INSERT INTO config VALUES ('13','smtp_port','');
INSERT INTO config VALUES ('14','smtp_user','');
INSERT INTO config VALUES ('15','smtp_pass','');
INSERT INTO config VALUES ('16','smtp_auth','false');
INSERT INTO config VALUES ('17','auto_verify','1');
INSERT INTO config VALUES ('18','reg_allowed','1');
INSERT INTO config VALUES ('19','notify_admin','1');
INSERT INTO config VALUES ('20','show_search','1');
INSERT INTO config VALUES ('21','maintenance','0');
INSERT INTO config VALUES ('22','maintenance_date','2019-02-05');
INSERT INTO config VALUES ('23','maintenance_hour','10:00');
INSERT INTO config VALUES ('24','maintenance_msg','Estamos em Manutenção no momento. Por favor, tente novamente mais tarde.');
INSERT INTO config VALUES ('25','cur_symbol','R$');
INSERT INTO config VALUES ('26','show_login','1');
INSERT INTO config VALUES ('27','site_locale','pt_BR');
INSERT INTO config VALUES ('28','currency','BRL');
INSERT INTO config VALUES ('29','page_search','pesquisa');
INSERT INTO config VALUES ('30','page_account','conta');
INSERT INTO config VALUES ('31','page_sitemap','mapasite');
INSERT INTO config VALUES ('32','page_activate','ativacao');
INSERT INTO config VALUES ('33','page_profile','perfil');
INSERT INTO config VALUES ('34','page_register','cadastro');
INSERT INTO config VALUES ('35','page_contact','contato');
INSERT INTO config VALUES ('36','page_login','login');
INSERT INTO config VALUES ('37','site_enable_ssl','0');
INSERT INTO config VALUES ('38','cms_version','1.0');
INSERT INTO config VALUES ('39','smtp_secure','false');
INSERT INTO config VALUES ('40','transaction_notify','1,2,3,4,5,6');


-- CREATING TABLE custom_fields
DROP TABLE IF EXISTS `custom_fields`;
CREATE TABLE `custom_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `name` varchar(55) DEFAULT NULL,
  `col` int(11) NOT NULL DEFAULT '6',
  `type` varchar(50) DEFAULT NULL,
  `options_value` text,
  `options_name` text,
  `req` tinyint(1) NOT NULL DEFAULT '0',
  `type_page` varchar(8) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `sorting` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- INSERTING DATA INTO custom_fields


-- CREATING TABLE custom_fields_data
DROP TABLE IF EXISTS `custom_fields_data`;
CREATE TABLE `custom_fields_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `field_value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- INSERTING DATA INTO custom_fields_data
INSERT INTO custom_fields_data VALUES ('1','5','teste','Teste');
INSERT INTO custom_fields_data VALUES ('2','19','newsletter','1');
INSERT INTO custom_fields_data VALUES ('3','19','notes','');
INSERT INTO custom_fields_data VALUES ('4','19','trial_used','1');
INSERT INTO custom_fields_data VALUES ('5','19','mem_expire','2019-06-05 01:17:23');


-- CREATING TABLE email_templates
DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE `email_templates` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `help` text,
  `body` text,
  `type` enum('news','mailer') DEFAULT 'mailer',
  `typeid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- INSERTING DATA INTO email_templates
INSERT INTO email_templates VALUES ('1','Email de Cadastro com Ativação','Ative seu Cadastro','Este modelo é usado para enviar um Email de Verificação de Cadastro, quando Configurações -> Cadastro Automático está marcado como NÃO','&#60;div id=&#34;ildi&#34; class=&#34;row&#34; style=&#34;box-sizing: border-box; display: flex; justify-content: flex-start; align-items: stretch; flex-wrap: nowrap; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;&#34;&#62;&#60;div id=&#34;iwc2&#34; class=&#34;cell&#34; style=&#34;box-sizing: border-box; flex-grow: 1; flex-basis: 100%; display: flex; max-width: 25%; min-height: 25%; border: 0 #212529 rgb(33, 37, 41);&#34;&#62;&#60;/div&#62;&#60;div id=&#34;i6pj&#34; class=&#34;cell&#34; style=&#34;box-sizing: border-box; flex-grow: 1; flex-basis: 100%; min-height: 50%; height: auto;&#34;&#62;&#60;div id=&#34;ik2j&#34; style=&#34;box-sizing: border-box; margin: 10px 0 0 0; padding: 30px 30px 30px 20px; background-color: #dfdfdf;&#34;&#62;[LOGO]&#60;/div&#62;&#60;div id=&#34;iza7&#34; style=&#34;box-sizing: border-box; padding: 40px 20px 40px 20px; background-color: #ffffff; border: 2px solid #dfdfdf;&#34;&#62;&#60;div id=&#34;i0vd4-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Olá &#60;b id=&#34;ifnm&#34; style=&#34;box-sizing: border-box;&#34;&#62;[NAME]&#60;/b&#62;,&#60;/div&#62;&#60;div id=&#34;iw57q-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;iu0wh-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;div id=&#34;i5dnn-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Obrigado por se cadastrar no site &#60;b id=&#34;i5rxo&#34; style=&#34;box-sizing: border-box;&#34;&#62;[SITE_NAME]&#60;/b&#62;!&#60;/div&#62;&#60;div id=&#34;imjn4-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;i3p47-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;div id=&#34;ixijk-2-4-3-3-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;O administrador do site definiu que é necessário o usuário ativar sua conta manualmente. Para realizar esse procedimento, clique no botão logo abaixo:&#60;/div&#62;&#60;div id=&#34;ixijk-2-4-3-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;inkqt-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;div id=&#34;ixijk-2-4-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;b id=&#34;ish32-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;a href=&#34;[INFO]&#34; title=&#34;Ativar Conta&#34; target=&#34;_blank&#34; id=&#34;igy6j-2&#34; class=&#34;link&#34; style=&#34;padding-top: 5px; padding-right: 10px; padding-bottom: 5px; padding-left: 10px; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; box-sizing: border-box; background-color: #0080dc; color: #ffffff; padding: 5px 10px 5px 10px; border-radius: 5px 5px 5px 5px;&#34;&#62;&#60;span id=&#34;immdw-2-2&#34; style=&#34;box-sizing: border-box; font-weight: normal;&#34;&#62;Ativar Conta&#60;/span&#62;&#60;/a&#62;&#60;/b&#62;&#60;/div&#62;&#60;div id=&#34;ib7xg-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;i824v-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;div id=&#34;imltr-2-2-2-4-2&#34; style=&#34;box-sizing: border-box; padding: 0 0 0 0;&#34;&#62;Caso não seja possível, copie o link abaixo e cole no seu navegador:&#60;/div&#62;&#60;div id=&#34;imltr-2-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;i62mx-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;div id=&#34;imltr-2-2-2-3-2-2&#34; style=&#34;box-sizing: border-box; font-size: 12px;&#34;&#62;[INFO]&#60;/div&#62;&#60;/div&#62;&#60;div id=&#34;im0e&#34; style=&#34;box-sizing: border-box; padding: 20px 20px 20px 20px; background-color: #0080dc; text-align: center; color: #ffffff;&#34;&#62;[SITE_NAME]&#60;div data-highlightable=&#34;1&#34; id=&#34;ibhyo-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Todos os direitos reservados&#60;/div&#62;&#60;/div&#62;&#60;/div&#62;&#60;div id=&#34;ilwj&#34; class=&#34;cell&#34; style=&#34;box-sizing: border-box; flex-grow: 1; flex-basis: 100%; max-width: 25%; min-height: 25%;&#34;&#62;&#60;/div&#62;&#60;/div&#62;&#60;style&#62;&#10;.link {&#10;  box-sizing: border-box;&#10;  background-color: rgb(0, 128, 220);&#10;  color: rgb(255, 255, 255);&#10;  padding-top: 5px;&#10;  padding-right: 10px;&#10;  padding-bottom: 5px;&#10;  padding-left: 10px;&#10;  border-top-left-radius: 5px;&#10;  border-top-right-radius: 5px;&#10;  border-bottom-right-radius: 5px;&#10;  border-bottom-left-radius: 5px;&#10;}&#10;@media (max-width: 768px) {&#10;  .row {&#10;    flex-wrap: wrap;&#10;  }&#10;}&#10;&#60;/style&#62;','mailer','');
INSERT INTO email_templates VALUES ('2','Troca de Senha','Troca de Senha','Esse modelo é utilizado para troca de senha','&#60;div id=&#34;ildi&#34; class=&#34;row&#34; style=&#34;box-sizing: border-box; display: flex; justify-content: flex-start; align-items: stretch; flex-wrap: nowrap; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;&#34;&#62;&#60;div id=&#34;iwc2&#34; class=&#34;cell&#34; style=&#34;box-sizing: border-box; flex-grow: 1; flex-basis: 100%; display: flex; max-width: 25%; min-height: 25%; border: 0 #212529 rgb(33, 37, 41); width: 600px;&#34;&#62;&#60;/div&#62;&#60;div id=&#34;i6pj&#34; class=&#34;cell&#34; style=&#34;box-sizing: border-box; flex-grow: 1; flex-basis: 100%; min-height: 50%; height: auto;&#34;&#62;&#60;div id=&#34;ik2j&#34; style=&#34;box-sizing: border-box; margin: 10px 0 0 0; padding: 30px 30px 30px 20px; background-color: #dfdfdf;&#34;&#62;[LOGO]&#60;/div&#62;&#60;div id=&#34;iza7&#34; style=&#34;box-sizing: border-box; padding: 40px 20px 40px 20px; background-color: #ffffff; border: 2px solid #dfdfdf; min-height: auto; width: 650px;&#34;&#62;&#60;div id=&#34;i0vd4-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Olá &#60;b id=&#34;ifnm&#34; style=&#34;box-sizing: border-box;&#34;&#62;[NAME]&#60;/b&#62;,&#60;/div&#62;&#60;div id=&#34;iw57q-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;iu0wh-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;div id=&#34;i5dnn-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Você solicitou a troca da sua senha no site &#60;b id=&#34;ixmsv&#34; style=&#34;box-sizing: border-box;&#34;&#62;[SITE_NAME]&#60;/b&#62;&#60;/div&#62;&#60;div id=&#34;imjn4-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;i3p47-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;div id=&#34;ixijk-2-4-3-3-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Aqui estão as informações necessárias para realizar a troca da senha:&#60;br id=&#34;iqp4z&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;div id=&#34;ih2ml&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;b id=&#34;irnmi&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;igcai&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/b&#62;&#60;/div&#62;&#60;div id=&#34;ipkwi&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;b id=&#34;if3wf&#34; style=&#34;box-sizing: border-box;&#34;&#62;Email:&#60;/b&#62; [EMAIL]&#60;/div&#62;&#60;div id=&#34;ig595&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;b id=&#34;i1z8l&#34; style=&#34;box-sizing: border-box;&#34;&#62;Token:&#60;/b&#62; [TOKEN]&#60;/div&#62;&#60;div id=&#34;iznqj&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;il1d4&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;div id=&#34;ibp1x&#34; style=&#34;box-sizing: border-box;&#34;&#62;Para realizar a troca, clique no botão abaixo:&#60;/div&#62;&#60;/div&#62;&#60;div id=&#34;ixijk-2-4-3-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;inkqt-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;div id=&#34;ixijk-2-4-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;b id=&#34;ish32-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;a href=&#34;[INFO]&#34; title=&#34;Ativar Conta&#34; target=&#34;_blank&#34; id=&#34;igy6j-2&#34; class=&#34;link&#34; style=&#34;padding-top: 5px; padding-right: 10px; padding-bottom: 5px; padding-left: 10px; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; box-sizing: border-box; background-color: #0080dc; color: #ffffff; padding: 5px 10px 5px 10px; border-radius: 5px 5px 5px 5px;&#34;&#62;&#60;span id=&#34;immdw-2-2&#34; style=&#34;box-sizing: border-box; font-weight: normal;&#34;&#62;Trocar Senha&#60;/span&#62;&#60;/a&#62;&#60;/b&#62;&#60;/div&#62;&#60;div id=&#34;ib7xg-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;i824v-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;div id=&#34;imltr-2-2-2-4-2&#34; style=&#34;box-sizing: border-box; padding: 0 0 0 0;&#34;&#62;Caso não seja possível, copie o link abaixo e cole no seu navegador: [INFO]&#60;/div&#62;&#60;div id=&#34;imltr-2-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;i62mx-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;div id=&#34;irzl1&#34; style=&#34;box-sizing: border-box; font-size: 12px; text-align: center;&#34;&#62;&#60;div id=&#34;i9dwv&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;i06d9&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;Caso não tenha solicitado nenhuma troca de senha, ignore essa mensagem.&#60;/div&#62;&#60;/div&#62;&#60;div id=&#34;im0e&#34; style=&#34;box-sizing: border-box; padding: 20px 20px 20px 20px; background-color: #0080dc; text-align: center; color: #ffffff;&#34;&#62;[SITE_NAME]&#60;div data-highlightable=&#34;1&#34; id=&#34;ibhyo-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Todos os direitos reservados&#60;/div&#62;&#60;/div&#62;&#60;/div&#62;&#60;div id=&#34;ilwj&#34; class=&#34;cell&#34; style=&#34;box-sizing: border-box; flex-grow: 1; flex-basis: 100%; max-width: 25%; min-height: 25%;&#34;&#62;&#60;/div&#62;&#60;/div&#62;&#60;style&#62;&#10;.link {&#10;  box-sizing: border-box;&#10;  background-color: rgb(0, 128, 220);&#10;  color: rgb(255, 255, 255);&#10;  padding-top: 5px;&#10;  padding-right: 10px;&#10;  padding-bottom: 5px;&#10;  padding-left: 10px;&#10;  border-top-left-radius: 5px;&#10;  border-top-right-radius: 5px;&#10;  border-bottom-right-radius: 5px;&#10;  border-bottom-left-radius: 5px;&#10;}&#10;@media (max-width: 768px) {&#10;  .row {&#10;    flex-wrap: wrap;&#10;  }&#10;}&#10;&#60;/style&#62;','mailer','');
INSERT INTO email_templates VALUES ('3','Email de Boas Vindas do Admin','Cadastro','Este modelo é usado para enviar e-mail de boas-vindas, quando o usuário é adicionado pelo administrador','&#60;div id=&#34;ildi&#34; class=&#34;row&#34; style=&#34;box-sizing: border-box; display: flex; justify-content: flex-start; align-items: stretch; flex-wrap: nowrap; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;&#34;&#62;&#60;div id=&#34;iwc2&#34; class=&#34;cell&#34; style=&#34;box-sizing: border-box; flex-grow: 1; flex-basis: 100%; display: flex; max-width: 25%; min-height: 25%; border: 0 #212529 rgb(33, 37, 41);&#34;&#62;&#60;/div&#62;&#60;div id=&#34;i6pj&#34; class=&#34;cell&#34; style=&#34;box-sizing: border-box; flex-grow: 1; flex-basis: 100%; min-height: 50%; height: auto;&#34;&#62;&#60;div id=&#34;ik2j&#34; style=&#34;box-sizing: border-box; margin: 10px 0 0 0; padding: 30px 30px 30px 20px; background-color: #dfdfdf;&#34;&#62;[LOGO]&#60;/div&#62;&#60;div id=&#34;iza7&#34; style=&#34;box-sizing: border-box; padding: 40px 20px 40px 20px; background-color: #ffffff; border: 2px solid #dfdfdf; width: 650px;&#34;&#62;&#60;div id=&#34;i0vd4-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Olá &#60;b id=&#34;ifnm&#34; style=&#34;box-sizing: border-box;&#34;&#62;[NAME]&#60;/b&#62;,&#60;/div&#62;&#60;div id=&#34;iw57q-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;iu0wh-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;div id=&#34;i5dnn-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Você foi cadastrado no site &#60;b style=&#34;box-sizing: border-box;&#34;&#62;[SITE_NAME]&#60;/b&#62; por um Administrador. Segue os dados para acesso a sua conta, por favor, guarde em um local seguro:&#60;/div&#62;&#60;div id=&#34;imjn4-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;i3p47-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;div id=&#34;ixijk-2-4-3-3-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;div id=&#34;is2q8-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;b style=&#34;box-sizing: border-box;&#34;&#62;Login:&#60;/b&#62; [USERNAME]&#60;/div&#62;&#60;div id=&#34;i7qrk-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;b style=&#34;box-sizing: border-box;&#34;&#62;Senha:&#60;/b&#62; [PASSWORD]&#60;/div&#62;&#60;/div&#62;&#60;div id=&#34;ixijk-2-4-3-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;inkqt-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;/div&#62;&#60;div id=&#34;im0e&#34; style=&#34;box-sizing: border-box; padding: 20px 20px 20px 20px; background-color: #0080dc; text-align: center; color: #ffffff;&#34;&#62;[SITE_NAME]&#60;div data-highlightable=&#34;1&#34; id=&#34;ibhyo-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Todos os direitos reservados&#60;/div&#62;&#60;/div&#62;&#60;/div&#62;&#60;div id=&#34;ilwj&#34; class=&#34;cell&#34; style=&#34;box-sizing: border-box; flex-grow: 1; flex-basis: 100%; max-width: 25%; min-height: 25%;&#34;&#62;&#60;/div&#62;&#60;/div&#62;&#60;style&#62;&#10;@media (max-width: 768px) {&#10;  .row {&#10;    flex-wrap: wrap;&#10;  }&#10;}&#10;&#60;/style&#62;','mailer','');
INSERT INTO email_templates VALUES ('4','Newsletter','Newsletter','Esse modelo é utilizado na Newsletter','&#60;div id=&#34;ildi&#34; class=&#34;row&#34; style=&#34;box-sizing: border-box; display: flex; justify-content: flex-start; align-items: stretch; flex-wrap: nowrap; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;&#34;&#62;&#60;div id=&#34;iwc2&#34; class=&#34;cell&#34; style=&#34;box-sizing: border-box; flex-grow: 1; flex-basis: 100%; display: flex; max-width: 25%; min-height: 25%; border: 0 #212529 rgb(33, 37, 41);&#34;&#62;&#60;/div&#62;&#60;div id=&#34;i6pj&#34; class=&#34;cell&#34; style=&#34;box-sizing: border-box; flex-grow: 1; flex-basis: 100%; min-height: 50%; height: auto;&#34;&#62;&#60;div id=&#34;ik2j&#34; style=&#34;box-sizing: border-box; margin: 10px 0 0 0; padding: 30px 30px 30px 20px; background-color: #dfdfdf;&#34;&#62;[LOGO]&#60;/div&#62;&#60;div id=&#34;iza7&#34; style=&#34;box-sizing: border-box; padding: 40px 20px 40px 20px; background-color: #ffffff; border: 2px solid #dfdfdf; width: 650px;&#34;&#62;&#60;div id=&#34;i5dnn-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Conteúdo Aqui&#60;/div&#62;&#60;/div&#62;&#60;div id=&#34;im0e&#34; style=&#34;box-sizing: border-box; padding: 20px 20px 20px 20px; background-color: #0080dc; text-align: center; color: #ffffff;&#34;&#62;[SITE_NAME]&#60;div data-highlightable=&#34;1&#34; id=&#34;ibhyo-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Todos os direitos reservados&#60;/div&#62;&#60;/div&#62;&#60;/div&#62;&#60;div id=&#34;ilwj&#34; class=&#34;cell&#34; style=&#34;box-sizing: border-box; flex-grow: 1; flex-basis: 100%; max-width: 25%; min-height: 25%;&#34;&#62;&#60;/div&#62;&#60;/div&#62;&#60;style&#62;&#10;@media (max-width: 768px) {&#10;  .row {&#10;    flex-wrap: wrap;&#10;  }&#10;}&#10;&#60;/style&#62;','news','');
INSERT INTO email_templates VALUES ('5','Email Simples','Nova Mensagem','Esse modelo é usado para enviar um email simples a um usuário','&#60;div id=&#34;ildi&#34; class=&#34;row&#34; style=&#34;box-sizing: border-box; display: flex; justify-content: flex-start; align-items: stretch; flex-wrap: nowrap; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;&#34;&#62;&#60;div id=&#34;iwc2&#34; class=&#34;cell&#34; style=&#34;box-sizing: border-box; flex-grow: 1; flex-basis: 100%; display: flex; max-width: 25%; min-height: 25%; border: 0 #212529 rgb(33, 37, 41);&#34;&#62;&#60;/div&#62;&#60;div id=&#34;i6pj&#34; class=&#34;cell&#34; style=&#34;box-sizing: border-box; flex-grow: 1; flex-basis: 100%; min-height: 50%; height: auto;&#34;&#62;&#60;div id=&#34;ik2j&#34; style=&#34;box-sizing: border-box; margin: 10px 0 0 0; padding: 30px 30px 30px 20px; background-color: #dfdfdf;&#34;&#62;[LOGO]&#60;/div&#62;&#60;div id=&#34;iza7&#34; style=&#34;box-sizing: border-box; padding: 40px 20px 40px 20px; background-color: #ffffff; border: 2px solid #dfdfdf; width: 650px;&#34;&#62;&#60;div id=&#34;i5dnn-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Conteúdo Aqui&#60;/div&#62;&#60;/div&#62;&#60;div id=&#34;im0e&#34; style=&#34;box-sizing: border-box; padding: 20px 20px 20px 20px; background-color: #0080dc; text-align: center; color: #ffffff;&#34;&#62;[SITE_NAME]&#60;div data-highlightable=&#34;1&#34; id=&#34;ibhyo-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Todos os direitos reservados&#60;/div&#62;&#60;/div&#62;&#60;/div&#62;&#60;div id=&#34;ilwj&#34; class=&#34;cell&#34; style=&#34;box-sizing: border-box; flex-grow: 1; flex-basis: 100%; max-width: 25%; min-height: 25%;&#34;&#62;&#60;/div&#62;&#60;/div&#62;&#60;style&#62;&#10;@media (max-width: 768px) {&#10;  .row {&#10;    flex-wrap: wrap;&#10;  }&#10;}&#10;&#60;/style&#62;','mailer','');
INSERT INTO email_templates VALUES ('6','Email de Cadastro com Boas Vindas','Bem-Vindo','Este modelo é usado para dar as boas-vindas ao usuário recém-registrado quando Configuração -> Verificação de Registro ->  Verificação Automática está definido como SIM','&#60;div id=&#34;ildi&#34; class=&#34;row&#34; style=&#34;box-sizing: border-box; display: flex; justify-content: flex-start; align-items: stretch; flex-wrap: nowrap; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;&#34;&#62;&#60;div id=&#34;iwc2&#34; class=&#34;cell&#34; style=&#34;box-sizing: border-box; flex-grow: 1; flex-basis: 100%; display: flex; max-width: 25%; min-height: 25%; border: 0 #212529 rgb(33, 37, 41);&#34;&#62;&#60;/div&#62;&#60;div id=&#34;i6pj&#34; class=&#34;cell&#34; style=&#34;box-sizing: border-box; flex-grow: 1; flex-basis: 100%; min-height: 50%; height: auto;&#34;&#62;&#60;div id=&#34;ik2j&#34; style=&#34;box-sizing: border-box; margin: 10px 0 0 0; padding: 30px 30px 30px 20px; background-color: #dfdfdf;&#34;&#62;[LOGO]&#60;/div&#62;&#60;div id=&#34;iza7&#34; style=&#34;box-sizing: border-box; padding: 40px 20px 40px 20px; background-color: #ffffff; border: 2px solid #dfdfdf;&#34;&#62;&#60;div id=&#34;i0vd4-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Olá &#60;b id=&#34;ifnm&#34; style=&#34;box-sizing: border-box;&#34;&#62;[NAME]&#60;/b&#62;,&#60;/div&#62;&#60;div id=&#34;iw57q-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;iu0wh-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;div id=&#34;i5dnn-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Obrigado por se cadastrar no site &#60;b id=&#34;i5rxo&#34; style=&#34;box-sizing: border-box;&#34;&#62;[SITE_NAME]&#60;/b&#62;!&#60;/div&#62;&#60;div id=&#34;imjn4-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;i3p47-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;div id=&#34;ixijk-2-4-3-3-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Segue abaixo os dados para acesso a sua conta, por favor, mantenha em um local seguro: &#60;/div&#62;&#60;div id=&#34;ib7xg-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;i824v-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;div id=&#34;imltr-2-2-2-4-2&#34; style=&#34;box-sizing: border-box; padding: 0 0 0 0;&#34;&#62;&#60;b style=&#34;box-sizing: border-box;&#34;&#62;Login:&#60;/b&#62; [USERNAME]&#60;/div&#62;&#60;div id=&#34;ijevi&#34; style=&#34;box-sizing: border-box; padding: 0 0 0 0;&#34;&#62;&#60;b id=&#34;ixaiz-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Senha:&#60;/b&#62; [PASSWORD]&#60;/div&#62;&#60;div id=&#34;imltr-2-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;i62mx-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;/div&#62;&#60;div id=&#34;im0e&#34; style=&#34;box-sizing: border-box; padding: 20px 20px 20px 20px; background-color: #0080dc; text-align: center; color: #ffffff;&#34;&#62;[SITE_NAME]&#60;div data-highlightable=&#34;1&#34; id=&#34;ibhyo-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Todos os direitos reservados&#60;/div&#62;&#60;/div&#62;&#60;/div&#62;&#60;div id=&#34;ilwj&#34; class=&#34;cell&#34; style=&#34;box-sizing: border-box; flex-grow: 1; flex-basis: 100%; max-width: 25%; min-height: 25%;&#34;&#62;&#60;/div&#62;&#60;/div&#62;&#60;style&#62;&#10;@media (max-width: 768px) {&#10;  .row {&#10;    flex-wrap: wrap;&#10;  }&#10;}&#10;&#60;/style&#62;','mailer','');
INSERT INTO email_templates VALUES ('7','Contato','Contato','Esse modelo é usado no formulário de contato.','&#60;div id=&#34;ildi&#34; class=&#34;row&#34; style=&#34;box-sizing: border-box; display: flex; justify-content: flex-start; align-items: stretch; flex-wrap: nowrap; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;&#34;&#62;&#60;div id=&#34;iwc2&#34; class=&#34;cell&#34; style=&#34;box-sizing: border-box; flex-grow: 1; flex-basis: 100%; display: flex; max-width: 25%; min-height: 25%; border: 0 #212529 rgb(33, 37, 41);&#34;&#62;&#60;/div&#62;&#60;div id=&#34;i6pj&#34; class=&#34;cell&#34; style=&#34;box-sizing: border-box; flex-grow: 1; flex-basis: 100%; min-height: 50%; height: auto;&#34;&#62;&#60;div id=&#34;ik2j&#34; style=&#34;box-sizing: border-box; margin: 10px 0 0 0; padding: 30px 30px 30px 20px; background-color: #dfdfdf;&#34;&#62;[LOGO]&#60;/div&#62;&#60;div id=&#34;iza7&#34; style=&#34;box-sizing: border-box; padding: 40px 20px 40px 20px; background-color: #ffffff; border: 2px solid #dfdfdf; width: 100%;&#34;&#62;&#60;div id=&#34;i0vd4-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Olá &#60;b id=&#34;ifnm&#34; style=&#34;box-sizing: border-box;&#34;&#62;Admin&#60;/b&#62;,&#60;/div&#62;&#60;div id=&#34;iw57q-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;iu0wh-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;div id=&#34;i5dnn-2-2-2-2-2&#34; style=&#34;box-sizing: border-box; width: 100%;&#34;&#62;Você tem uma nova solicitação de contato:&#60;/div&#62;&#60;div id=&#34;imjn4-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;i3p47-2-2-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;div id=&#34;ixijk-2-4-3-3-2&#34; style=&#34;box-sizing: border-box; width: 600px;&#34;&#62;&#60;b style=&#34;box-sizing: border-box;&#34;&#62;Nome:&#60;/b&#62; [NAME]&#60;br id=&#34;iv58g-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;b style=&#34;box-sizing: border-box;&#34;&#62;Email:&#60;/b&#62; [EMAIL]&#60;div id=&#34;iatsu-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;b style=&#34;box-sizing: border-box;&#34;&#62;Assunto:&#60;/b&#62; [SUBJECT]&#60;/div&#62;&#60;div id=&#34;ii7no-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;b style=&#34;box-sizing: border-box;&#34;&#62;IP:&#60;/b&#62; [IP]&#60;/div&#62;&#60;div id=&#34;immiy-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;b style=&#34;box-sizing: border-box;&#34;&#62;Mensagem:&#60;/b&#62; [MESSAGE]&#60;/div&#62;&#60;/div&#62;&#60;div id=&#34;ixijk-2-4-3-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;inkqt-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;/div&#62;&#60;div id=&#34;im0e&#34; style=&#34;box-sizing: border-box; padding: 20px 20px 20px 20px; background-color: #0080dc; text-align: center; color: #ffffff;&#34;&#62;[SITE_NAME]&#60;div data-highlightable=&#34;1&#34; id=&#34;ibhyo-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Todos os direitos reservados&#60;/div&#62;&#60;/div&#62;&#60;/div&#62;&#60;div id=&#34;ilwj&#34; class=&#34;cell&#34; style=&#34;box-sizing: border-box; flex-grow: 1; flex-basis: 100%; max-width: 25%; min-height: 25%;&#34;&#62;&#60;/div&#62;&#60;/div&#62;&#60;style&#62;&#10;@media (max-width: 768px) {&#10;  .row {&#10;    flex-wrap: wrap;&#10;  }&#10;}&#10;&#60;/style&#62;','mailer','');


-- CREATING TABLE gateways
DROP TABLE IF EXISTS `gateways`;
CREATE TABLE `gateways` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `displayname` varchar(255) NOT NULL,
  `dir` varchar(255) NOT NULL,
  `live` tinyint(1) NOT NULL DEFAULT '1',
  `info1` varchar(255) NOT NULL,
  `info2` varchar(255) NOT NULL,
  `info3` text,
  `is_recurring` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- INSERTING DATA INTO gateways
INSERT INTO gateways VALUES ('1','Depósito Transferência','offline','0','Nome do Banco

Nome: 
Agência: 
Conta Corrente:  

Enviar comprovante de pagamento para o endereço de e-mail:','','','0','0');
INSERT INTO gateways VALUES ('2','PayPal','paypal','0','paypal@address.com','','','0','0');
INSERT INTO gateways VALUES ('3','Mercado Pago','mercadopago','1','','','','0','0');
INSERT INTO gateways VALUES ('4','PagSeguro','pagseguro','1','hitaloramon@live.com','37456100F75846CABD99784CC06DA9A1','','0','1');


-- CREATING TABLE layout
DROP TABLE IF EXISTS `layout`;
CREATE TABLE `layout` (
  `plug_id` int(11) NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL,
  `page_slug` varchar(50) DEFAULT NULL,
  `is_content` tinyint(1) NOT NULL DEFAULT '0',
  `place` varchar(20) NOT NULL,
  `space` tinyint(1) NOT NULL DEFAULT '12',
  `position` int(11) NOT NULL,
  KEY `idx_layout_id` (`page_id`),
  KEY `idx_plugin_id` (`plug_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- INSERTING DATA INTO layout


-- CREATING TABLE memberships
DROP TABLE IF EXISTS `memberships`;
CREATE TABLE `memberships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL DEFAULT '0.00',
  `days` int(5) NOT NULL DEFAULT '0',
  `period` enum('D','S','M','A') NOT NULL DEFAULT 'D',
  `trial` tinyint(1) NOT NULL DEFAULT '0',
  `recurring` tinyint(1) NOT NULL DEFAULT '0',
  `private` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- INSERTING DATA INTO memberships
INSERT INTO memberships VALUES ('2','Prata','Plano Prata','','15.00','3','M','1','0','0','1');
INSERT INTO memberships VALUES ('3','Bronze','Plano Bronze','','10.00','1','M','0','0','0','1');
INSERT INTO memberships VALUES ('1','Ouro','Plano Ouro','','30.00','1','A','0','0','0','1');


-- CREATING TABLE menus
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `page_slug` varchar(255) DEFAULT NULL,
  `mod_id` int(6) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `caption` varchar(100) DEFAULT NULL,
  `content_type` varchar(20) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `target` enum('_self','_blank') NOT NULL DEFAULT '_blank',
  `icon` varchar(50) DEFAULT NULL,
  `cols` tinyint(1) NOT NULL DEFAULT '1',
  `position` int(11) NOT NULL DEFAULT '0',
  `home_page` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `content_id` (`active`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- INSERTING DATA INTO menus
INSERT INTO menus VALUES ('35','0','2','login','0','Login','login','','page','','_self','','1','4','0','1');
INSERT INTO menus VALUES ('34','0','6','perfil','0','Perfil','perfil','','page','','_self','','1','3','0','1');
INSERT INTO menus VALUES ('31','0','3','conta','0','Painel de Controle','painel-de-controle','','page','','_self','','1','6','0','1');
INSERT INTO menus VALUES ('18','0','8','cadastro','0','Cadastro','cadastro','','page','','_self','','1','5','0','1');
INSERT INTO menus VALUES ('24','0','1','pagina-inicial','0','Inicio','inicio','','page','#','_self','fas fa-home','1','1','0','1');
INSERT INTO menus VALUES ('12','0','6','pesquisa','0','Pesquisa','pesquisa','','page','','_self','','1','2','0','1');


-- CREATING TABLE mod_blog
DROP TABLE IF EXISTS `mod_blog`;
CREATE TABLE `mod_blog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `membership_id` varchar(20) DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `body` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `thumb` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `hits` int(6) unsigned DEFAULT '0',
  `show_author` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `show_comments` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `show_created` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `keywords` varchar(200) DEFAULT NULL,
  `description` text,
  `modified` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- INSERTING DATA INTO mod_blog
INSERT INTO mod_blog VALUES ('2','3','5','','Como saber se minha placa suporta ray tracing?','como-saber-se-minha-placa-suporta-ray-tracing','&#60;div id=&#34;i4n5&#34; style=&#34;box-sizing: border-box; color: #000000;&#34;&#62;&#60;div id=&#34;iu23-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;A Nvidia oferece suporte à tecnologia via hardware em todas as placas GeForce RTX. Portanto, esses modelos possuem os componentes internos responsáveis pelo processamento de dados dos efeitos em ray tracing, atuando de forma nativa. A novidade é a expansão do suporte em algumas placas da linha GTX por meio de software. São elas:&#60;/div&#62;&#60;div id=&#34;iid4-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;iqpf-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;div id=&#34;i9hp-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;b id=&#34;i72i-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;GeForce GTX 1060&#60;/b&#62;&#60;/div&#62;&#60;div id=&#34;inti-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;b id=&#34;iq5k-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;GeForce GTX 1070&#60;/b&#62;&#60;/div&#62;&#60;div id=&#34;icxn-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;b id=&#34;io0lv-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;GeForce GTX 1080&#60;/b&#62;&#60;/div&#62;&#60;div id=&#34;ii33p-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;b id=&#34;irb94-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;GeForce GTX 1080 Ti&#60;/b&#62;&#60;/div&#62;&#60;div id=&#34;irblw-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;b id=&#34;i8b6l-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;GeForce GTX 1660&#60;/b&#62;&#60;/div&#62;&#60;div id=&#34;ieijh-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;b id=&#34;i33hi-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;GeForce GTX 1660 Ti&#60;/b&#62;&#60;/div&#62;&#60;div id=&#34;ieijh-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;b id=&#34;i3q1s&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;ic9t9&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/b&#62;&#60;/div&#62;&#60;div id=&#34;id4x5-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Nesses casos, o suporte ao ray tracing é obtido pela atualização dos drivers, o que equivale a dizer que a implementação da técnica nessas placas não terá a mesma qualidade e desempenho alcançados pelas RTX. Apesar disso, a opção é interessante para gamers que desejam experimentar os efeitos da tecnologia nos jogos.&#60;/div&#62;&#60;/div&#62;&#60;div id=&#34;i79su&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;','modules/blog/nvidia-geforce-gtx-1660-ti.jpg','314','1','1','1','teste, palavras','A Nvidia oferece suporte à tecnologia via hardware em todas as placas GeForce RTX. A novidade é a expansão do suporte em algumas placas da linha GTX por meio de software.','2019-07-31 17:26:21','2019-04-24 14:42:58','1');
INSERT INTO mod_blog VALUES ('1','3','5','','Xiaomi anuncia smart TV com 4K que vira obra de arte','postagem-de-teste-1','&#60;div id=&#34;i6kt&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;div id=&#34;ithg&#34; style=&#34;box-sizing: border-box;&#34;&#62;A Xiaomi anunciou as novas smart TVs Mi TV E e Mi Mural TV nesta semana. Os modelos trazem sistema Android TV e design premium com bordas finas. A Mi TV E, que tem opções de 32&#34;, 43&#34;, 55&#34; e 65 polegadas, oferece controle remoto Bluetooth com suporte a comandos por voz. Já a Mi Mural TV conta com tela grande de 65 polegadas e recurso de galeria, transformando o televisor em uma grande moldura para obras de arte.&#60;div id=&#34;i1yn-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;iaxk-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;div id=&#34;i1yn-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;As TVs estão à venda no mercado chinês com preços a partir de 1.099 yuans, algo em torno de R$ 650. Vale ressaltar que a Xiaomi não atua oficialmente no Brasil, o que significa que os televisores não devem chegar no mercado nacional.&#60;/div&#62;&#60;/div&#62;&#60;/div&#62;','modules/blog/xiaomi-mi-mural-tv-0.jpg','59','1','1','1','teste, palavras','As TVs estão à venda no mercado chinês com preços a partir de 1.099 yuans, algo em torno de R$ 650. Vale ressaltar que a Xiaomi não atua oficialmente no Brasil, o que significa que os televisores não devem chegar no mercado nacional.','2019-04-26 10:48:38','2019-04-23 22:09:58','1');
INSERT INTO mod_blog VALUES ('3','2','5','','Ukyo é destaque em trailer inédito de Samurai Shodown','ukyo-e-destaque-em-trailer-inedito-de-samurai-shodown','&#60;div id=&#34;i6mn&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;div id=&#34;ih2x-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Samurai Shodown, reboot da clássica franquia de luta da SNK, recebeu um trailer inédito nesta quinta-feira (25). Ele faz parte de uma série que destaca os lutadores jogáveis do elenco. Desta vez, Tachibana Ukyo, espadachim tuberculoso que é uma das figuras mais populares do game, teve os seus golpes normais e especiais apresentados. O jogo estará disponível em 27 de junho para PS4 e Xbox One.&#60;/div&#62;&#60;div id=&#34;ic1d-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;i3b9-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;Ukyo é conhecido como um lutador mais defensivo, dispondo de rápidas investidas para punir os erros dos adversários. Vários dos seus golpes clássicos estão de volta, tais como o corte aéreo flamejante Tsubame Gaeshi e as sequências de cortes horizontais Zanzou Fumikomi Giri.&#60;div id=&#34;i2nt-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;ijwk-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;div id=&#34;i2um-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;O elenco base de Samurai Shodown conta com 16 personagens, sendo que três deles são inéditos. Há a intenção de alimentar o jogo com DLCs que adicionarão mais quatro lutadores até fevereiro de 2020.&#60;/div&#62;&#60;div id=&#34;i2um-2-2-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;br id=&#34;ighn4&#34; style=&#34;box-sizing: border-box;&#34;&#62;&#60;/div&#62;&#60;/div&#62;&#60;/div&#62;&#60;iframe allowfullscreen=&#34;allowfullscreen&#34; id=&#34;iyic&#34; src=&#34;https://www.youtube.com/embed/S2O9mEj6WzA?&#34; style=&#34;box-sizing: border-box; width: 100%; height: 480px;&#34;&#62;&#60;/iframe&#62;','modules/blog/ukyo-samurai-shodown-trailer-techtudo.jpg','225','1','1','1','jogos, samurai, shodown','O espadachim tuberculoso que marcou a franquia Samurai Shodown está de volta','2019-04-26 11:34:30','2019-04-26 10:57:43','1');


-- CREATING TABLE mod_blog_categories
DROP TABLE IF EXISTS `mod_blog_categories`;
CREATE TABLE `mod_blog_categories` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- INSERTING DATA INTO mod_blog_categories
INSERT INTO mod_blog_categories VALUES ('1','Esportes','esportes','fas fa-futbol','1');
INSERT INTO mod_blog_categories VALUES ('2','Games','games','fas fa-gamepad','1');
INSERT INTO mod_blog_categories VALUES ('3','Tecnologia','tecnologia','fas fa-desktop','1');
INSERT INTO mod_blog_categories VALUES ('4','Decoração','decoracao','fas fa-air-freshener','1');


-- CREATING TABLE mod_blog_comments
DROP TABLE IF EXISTS `mod_blog_comments`;
CREATE TABLE `mod_blog_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `id_post` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `comment` varchar(450) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- INSERTING DATA INTO mod_blog_comments
INSERT INTO mod_blog_comments VALUES ('1','5','3','0','Hitalo','hitaloramon@live.com','Testando o sistema de comentário do GeekCMS.','2019-04-26 15:29:34','1');


-- CREATING TABLE mod_events
DROP TABLE IF EXISTS `mod_events`;
CREATE TABLE `mod_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `all_day` tinyint(1) NOT NULL DEFAULT '0',
  `color` varchar(25) NOT NULL,
  `textColor` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- INSERTING DATA INTO mod_events
INSERT INTO mod_events VALUES ('7','Marks Pregador','Praça do Peixe','2019-03-03 14:00:00','2019-03-06 00:00:00','0','#dfbb33','#f6f6f6');
INSERT INTO mod_events VALUES ('8','Rogério','Teste','2019-03-26 00:00:00','2019-03-29 00:00:00','0','#df3333','#f6f6f6');


-- CREATING TABLE mod_gallery_album
DROP TABLE IF EXISTS `mod_gallery_album`;
CREATE TABLE `mod_gallery_album` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `folder` varchar(30) DEFAULT NULL,
  `itens` int(3) NOT NULL DEFAULT '30',
  `watermark` tinyint(1) NOT NULL DEFAULT '0',
  `cover` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- INSERTING DATA INTO mod_gallery_album


-- CREATING TABLE mod_gallery_images
DROP TABLE IF EXISTS `mod_gallery_images`;
CREATE TABLE `mod_gallery_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(6) NOT NULL DEFAULT '0',
  `title` varchar(100) DEFAULT NULL,
  `likes` int(6) NOT NULL DEFAULT '0',
  `thumb` varchar(100) DEFAULT NULL,
  `sorting` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- INSERTING DATA INTO mod_gallery_images


-- CREATING TABLE mod_rss
DROP TABLE IF EXISTS `mod_rss`;
CREATE TABLE `mod_rss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `limit_rss` int(11) DEFAULT '5',
  `show_date` int(11) NOT NULL DEFAULT '1',
  `show_desc` int(11) NOT NULL DEFAULT '1',
  `limit_desc` int(11) NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- INSERTING DATA INTO mod_rss
INSERT INTO mod_rss VALUES ('12','Teste 2','http://pox.globo.com/rss/g1/brasil/','5','1','1','300');


-- CREATING TABLE mod_slider
DROP TABLE IF EXISTS `mod_slider`;
CREATE TABLE `mod_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `config` blob NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- INSERTING DATA INTO mod_slider
INSERT INTO mod_slider VALUES ('8','Teste','{\"id\":\"8\",\"width\":1920,\"height\":600,\"title\":\"Teste\",\"showArrows\":true,\"showPages\":true,\"autoPlay\":true,\"stopAutoPlayMouseOver\":true,\"effectsFromFirst\":false,\"backgroundColor\":\"rgba(0, 0, 0, 0.1)\",\"data\":[{\"id\":\"11\",\"index\":0,\"color\":\"\",\"image\":\"5cdb664ea2c38_1557882446.jpg\",\"imagePath\":\"5cdb664ea2c38_1557882446.jpg\",\"transitionIn\":\"rotateCarouselTopIn\",\"transitionOut\":\"fade\",\"timeDelay\":6,\"isActive\":false,\"layers\":[],\"width\":1000,\"height\":350},{\"id\":\"22\",\"index\":1,\"color\":\"\",\"image\":\"5d5eddfd2d1dc_1566498301.jpg\",\"imagePath\":\"5d5eddfd2d1dc_1566498301.jpg\",\"transitionIn\":\"rotateSlideIn\",\"transitionOut\":\"fade\",\"timeDelay\":6,\"isActive\":true,\"layers\":[],\"width\":1920,\"height\":600}]}','2019-05-14 22:07:50');


-- CREATING TABLE modules
DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL,
  `info` text,
  `module_alias` varchar(50) NOT NULL,
  `hasconfig` tinyint(1) NOT NULL DEFAULT '0',
  `system` tinyint(1) NOT NULL DEFAULT '0',
  `include_page` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `ver` varchar(4) DEFAULT '1.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- INSERTING DATA INTO modules
INSERT INTO modules VALUES ('1','Galeria','Galeria de Imagens','gallery','1','1','1','2017-01-14 06:19:32','1.0');
INSERT INTO modules VALUES ('2','Sliders','Sliders','slider','1','1','0','2016-10-15 23:50:23','1.0');
INSERT INTO modules VALUES ('3','Leitor RSS','	Leitor RSS','rss','1','1','0','2016-10-16 00:00:00','1.0');
INSERT INTO modules VALUES ('4','Eventos','Exiba eventos no seu site com um calendário completo','events','1','1','1','2017-08-14 00:00:00','1.0');
INSERT INTO modules VALUES ('5','Blog','Exiba artigos, postagens ou notícias no seu site','blog','0','0','1','2019-02-02 00:00:00','1.0');


-- CREATING TABLE notification
DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `msg` text NOT NULL,
  `icon` varchar(50) NOT NULL,
  `color` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- INSERTING DATA INTO notification


-- CREATING TABLE pages
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `caption` varchar(150) DEFAULT NULL,
  `type_page` enum('normal','login','activate','account','register','search','profile','home') NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `membership_id` varchar(20) NOT NULL,
  `module_id` int(4) NOT NULL DEFAULT '0',
  `module_name` varchar(50) DEFAULT NULL,
  `access` enum('1','2','3') NOT NULL DEFAULT '1',
  `body` mediumtext,
  `keywords` text NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- INSERTING DATA INTO pages
INSERT INTO pages VALUES ('7','Cadastro','cadastro','Cadastro de Usuário','register','0','','0','','1','&#60;div class=&#34;container&#34;&#62;&#10;        &#60;div class=&#34;row&#34;&#62;&#10;            &#60;div class=&#34;col-sm-12 ui-resizable&#34; data-type=&#34;container-content&#34;&#62;&#60;div data-type=&#34;component-blank&#34;&#62;&#10;                &#60;div class=&#34;widget&#34; data-widget=&#34;Página de Cadastro&#34;&#62;{{page|register}}&#60;/div&#62;&#10;            &#60;/div&#62;&#60;/div&#62;&#10;        &#60;/div&#62;&#10;    &#60;/div&#62;','teste','teste','2019-01-28 21:31:22','0','1');
INSERT INTO pages VALUES ('2','Login','login','Login do Usuário','login','0','','0','','1','&#60;div class=&#34;row&#34;&#62;&#10;            &#60;div class=&#34;col-sm-12 ui-resizable&#34; data-type=&#34;container-content&#34;&#62;&#60;div data-type=&#34;component-blank&#34;&#62;&#10;                &#60;div class=&#34;container&#34;&#62;&#10;        &#60;div class=&#34;widget&#34; data-widget=&#34;Página de Login&#34;&#62;{{page|login}}&#60;/div&#62;&#10;    &#60;/div&#62;&#10;            &#60;/div&#62;&#60;/div&#62;&#10;        &#60;/div&#62;','Login','Login','2019-01-28 21:31:22','0','1');
INSERT INTO pages VALUES ('3','Conta','conta','Conta','account','0','','0','','1','&#60;div class=&#34;row&#34;&#62;&#10;            &#60;div class=&#34;col-sm-12 ui-resizable&#34; data-type=&#34;container-content&#34;&#62;&#60;div data-type=&#34;component-blank&#34;&#62;&#10;                &#60;div class=&#34;container&#34;&#62;&#10;        &#60;div class=&#34;widget&#34; data-widget=&#34;Página de Conta&#34;&#62;{{page|account}}&#60;/div&#62;&#10;    &#60;/div&#62;&#10;            &#60;/div&#62;&#60;/div&#62;&#10;        &#60;/div&#62;','Conta','Conta','2019-01-28 21:31:22','0','1');
INSERT INTO pages VALUES ('4','Ativação','ativacao','Ativação de Conta','activate','0','','0','','1','&#60;div class=&#34;row&#34;&#62;&#10;            &#60;div class=&#34;col-sm-12 ui-resizable&#34; data-type=&#34;container-content&#34;&#62;&#60;div data-type=&#34;component-blank&#34;&#62;&#10;                &#60;div class=&#34;container&#34;&#62;&#10;        &#60;div class=&#34;widget&#34; data-widget=&#34;Página de Ativação&#34;&#62;{{page|activate}}&#60;/div&#62;&#10;    &#60;/div&#62;&#10;            &#60;/div&#62;&#60;/div&#62;&#10;        &#60;/div&#62;','Ativação','Ativação','2019-01-28 21:31:22','0','1');
INSERT INTO pages VALUES ('5','Pesquisa','pesquisa','Pesquisa','search','0','','0','','1','&#60;div class=&#34;container&#34;&#62;&#10;        &#60;div class=&#34;row&#34;&#62;&#10;            &#60;div class=&#34;col-sm-12 ui-resizable&#34; data-type=&#34;container-content&#34;&#62;&#60;div data-type=&#34;component-blank&#34;&#62;&#10;                &#60;div class=&#34;widget&#34; data-widget=&#34;Página de Pesquisa&#34;&#62;{{page|search}}&#60;/div&#62;&#10;            &#60;/div&#62;&#60;/div&#62;&#10;        &#60;/div&#62;&#10;    &#60;/div&#62;','Pesquisa','Pesquisa','2019-01-28 21:31:22','0','1');
INSERT INTO pages VALUES ('6','Perfil','perfil','Perfil','profile','0','','0','','1','&#60;div class=&#34;row&#34;&#62;&#10;            &#60;div class=&#34;col-sm-12 ui-resizable&#34; data-type=&#34;container-content&#34;&#62;&#60;div data-type=&#34;component-blank&#34;&#62;&#10;                &#60;div class=&#34;container&#34;&#62;&#10;        &#60;div class=&#34;widget&#34; data-widget=&#34;Página de Perfil&#34;&#62;{{page|profile}}&#60;/div&#62;&#10;    &#60;/div&#62;&#10;            &#60;/div&#62;&#60;/div&#62;&#10;        &#60;/div&#62;','Perfil','Perfil','2019-01-28 21:31:22','0','1');
INSERT INTO pages VALUES ('1','Página Inicial','pagina-inicial','Página Inicial','home','0','','0','','1','&#60;div class=&#34;container&#34;&#62;&#10;        &#60;div class=&#34;row&#34; style=&#34;padding: 0px; background-color: rgb(255, 255, 255);&#34;&#62;&#10;            &#60;div class=&#34;col-sm-12 ui-resizable col-xl-null col-xl-12&#34; data-type=&#34;container-content&#34; style=&#34;&#34;&#62;&#60;div data-type=&#34;component-text&#34;&#62;&#10;&#60;p&#62;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro labore architecto fuga tempore omnis aliquid, rerum numquam deleniti ipsam earum velit aliquam deserunt, molestiae officiis mollitia accusantium suscipit fugiat esse magnam eaque cumque, iste corrupti magni? Illo dicta saepe, maiores fugit aliquid consequuntur aut, rem ex iusto dolorem molestias obcaecati eveniet vel voluptatibus recusandae illum, voluptatem! Odit est possimus nesciunt.&#60;/p&#62;&#10;&#60;/div&#62;&#10;&#60;/div&#62;&#10;        &#60;/div&#62;&#10;    &#60;/div&#62;','GeekCMS, inicio, cms','Página Inicial GeekCMS','2019-01-28 21:31:22','0','1');
INSERT INTO pages VALUES ('52','Blog','blog','','normal','0','','5','blog','1','&#60;div class=&#34;container&#34;&#62;&#10;        &#60;div class=&#34;row&#34;&#62;&#10;            &#60;div class=&#34;col-sm-12 ui-resizable&#34; data-type=&#34;container-content&#34;&#62;&#60;div class=&#34;row&#34;&#62;&#10;        &#60;div class=&#34;col-sm-8 ui-resizable&#34; data-type=&#34;container-content&#34;&#62;&#60;div data-type=&#34;component-blank&#34;&#62;&#10;                &#60;div class=&#34;widget&#34; data-widget=&#34;Blog&#34;&#62;{{module|blog|5}}&#60;/div&#62;&#10;            &#60;/div&#62;&#60;/div&#62;&#10;        &#60;div class=&#34;col-sm-4 ui-resizable&#34; data-type=&#34;container-content&#34;&#62;&#60;div data-type=&#34;component-blank&#34;&#62;&#10;                &#60;div class=&#34;widget&#34; data-widget=&#34;Categorias do Blog&#34;&#62;{{widget|blogcategories|0}}&#60;/div&#62;&#10;            &#60;/div&#62;&#60;div data-type=&#34;component-blank&#34;&#62;&#10;                &#60;div class=&#34;widget&#34; data-widget=&#34;Popular&#34;&#62;{{widget|blogpopular|0}}&#60;/div&#62;&#10;            &#60;/div&#62;&#60;/div&#62;&#10;    &#60;/div&#62;&#60;/div&#62;&#10;        &#60;/div&#62;&#10;    &#60;/div&#62;','blog','Página de Blog','2019-04-23 23:10:36','5','1');


-- CREATING TABLE permissions_actions
DROP TABLE IF EXISTS `permissions_actions`;
CREATE TABLE `permissions_actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `action` text,
  `content_view` int(11) NOT NULL DEFAULT '1',
  `id_group` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- INSERTING DATA INTO permissions_actions
INSERT INTO permissions_actions VALUES ('351','page','view,add,edit,delete','1','1');
INSERT INTO permissions_actions VALUES ('352','user','view,add,edit,delete','1','1');
INSERT INTO permissions_actions VALUES ('353','menu','view,add,edit,delete','1','1');
INSERT INTO permissions_actions VALUES ('354','widget','view,add,edit,delete','1','1');
INSERT INTO permissions_actions VALUES ('355','layout','edit,delete','1','1');
INSERT INTO permissions_actions VALUES ('356','module','view,add,edit,delete','1','1');
INSERT INTO permissions_actions VALUES ('357','permission','view,add,edit,delete','1','1');
INSERT INTO permissions_actions VALUES ('358','membership','view,add,edit,delete','1','1');
INSERT INTO permissions_actions VALUES ('359','filemanager','view','1','1');
INSERT INTO permissions_actions VALUES ('360','gateway','view,edit','1','1');
INSERT INTO permissions_actions VALUES ('361','backup','view,add,edit,delete','1','1');
INSERT INTO permissions_actions VALUES ('362','customfield','view,add,edit,delete','1','1');
INSERT INTO permissions_actions VALUES ('363','install','view','1','1');
INSERT INTO permissions_actions VALUES ('364','system','view,edit','1','1');
INSERT INTO permissions_actions VALUES ('365','financial','view','1','1');
INSERT INTO permissions_actions VALUES ('366','notification','view,delete','1','1');
INSERT INTO permissions_actions VALUES ('367','trash','view,edit,delete','1','1');
INSERT INTO permissions_actions VALUES ('368','mod/gallery','view,add,edit,delete','1','1');
INSERT INTO permissions_actions VALUES ('369','mod/rss','view,add,edit,delete','1','1');
INSERT INTO permissions_actions VALUES ('370','mod/events','view,add,edit,delete','1','1');
INSERT INTO permissions_actions VALUES ('371','mod/slider','view,add,edit,delete','1','1');


-- CREATING TABLE permissions_groups
DROP TABLE IF EXISTS `permissions_groups`;
CREATE TABLE `permissions_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- INSERTING DATA INTO permissions_groups
INSERT INTO permissions_groups VALUES ('1','Super Admin');
INSERT INTO permissions_groups VALUES ('2','Admin');


-- CREATING TABLE permissions_params
DROP TABLE IF EXISTS `permissions_params`;
CREATE TABLE `permissions_params` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `config_view` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- INSERTING DATA INTO permissions_params
INSERT INTO permissions_params VALUES ('1','page','Páginas','view,add,edit,delete','0');
INSERT INTO permissions_params VALUES ('2','user','Usuários','view,add,edit,delete','0');
INSERT INTO permissions_params VALUES ('3','menu','Menus','view,add,edit,delete','0');
INSERT INTO permissions_params VALUES ('4','widget','Widgets','view,add,edit,delete','0');
INSERT INTO permissions_params VALUES ('5','layout','Layout','edit,delete','0');
INSERT INTO permissions_params VALUES ('6','module','Módulos','view,add,edit,delete','0');
INSERT INTO permissions_params VALUES ('7','permission','Permissões','view,add,edit,delete','0');
INSERT INTO permissions_params VALUES ('8','membership','Planos de Acesso','view,add,edit,delete','0');
INSERT INTO permissions_params VALUES ('9','filemanager','Arquivos','view','0');
INSERT INTO permissions_params VALUES ('10','gateway','Formas de Pagamento','view,edit','0');
INSERT INTO permissions_params VALUES ('11','backup','Backup','view,add,edit,delete','0');
INSERT INTO permissions_params VALUES ('12','customfield','Campos Personalizados','view,add,edit,delete','0');
INSERT INTO permissions_params VALUES ('13','install','Instalador','view','0');
INSERT INTO permissions_params VALUES ('14','system','Configurações do Sistema','view,edit','0');
INSERT INTO permissions_params VALUES ('15','financial','Financeiro','view','0');
INSERT INTO permissions_params VALUES ('16','notification','Notificações','view,delete','0');
INSERT INTO permissions_params VALUES ('17','trash','Lixeira','view,edit,delete','0');
INSERT INTO permissions_params VALUES ('18','mod/gallery','Galeria','view,add,edit,delete','0');
INSERT INTO permissions_params VALUES ('19','mod/rss','Leitor RSS','view,add,edit,delete','0');
INSERT INTO permissions_params VALUES ('20','mod/events','Eventos','view,add,edit,delete','0');
INSERT INTO permissions_params VALUES ('22','mod/slider','Slider','view,edit,add,delete','0');


-- CREATING TABLE social
DROP TABLE IF EXISTS `social`;
CREATE TABLE `social` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- INSERTING DATA INTO social
INSERT INTO social VALUES ('1','fab fa-facebook-f','Facebook','http://facebook.com');
INSERT INTO social VALUES ('2','fab fa-instagram','Instagram','http://instagram.com');
INSERT INTO social VALUES ('3','fab fa-twitter','Twitter','http://twitter.com');
INSERT INTO social VALUES ('4','fab fa-youtube','YouTube','http://youtube.com');


-- CREATING TABLE stats
DROP TABLE IF EXISTS `stats`;
CREATE TABLE `stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `device` varchar(255) NOT NULL,
  `os` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `region_code` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- INSERTING DATA INTO stats


-- CREATING TABLE transactions
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `txn_id` varchar(255) DEFAULT NULL,
  `membership_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `received` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `tax` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `discount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `total` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `currency` varchar(4) DEFAULT NULL,
  `type_payment` varchar(50) NOT NULL,
  `pp` varchar(20) NOT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `type` enum('member','shop') NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 = Aguardando Pagamento / 2 = Em Análise / 3 = Pago / 4 = Devolvido / 5 = Cancelado',
  PRIMARY KEY (`id`),
  KEY `idx_membership` (`membership_id`),
  KEY `idx_user` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- INSERTING DATA INTO transactions


-- CREATING TABLE trash
DROP TABLE IF EXISTS `trash`;
CREATE TABLE `trash` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) DEFAULT NULL,
  `dataset` blob,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- INSERTING DATA INTO trash


-- CREATING TABLE users
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `membership_id` tinyint(3) NOT NULL DEFAULT '0',
  `mem_expire` datetime DEFAULT '2000-01-01 00:00:00',
  `trial_used` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(60) NOT NULL,
  `fname` varchar(32) NOT NULL,
  `lname` varchar(32) NOT NULL,
  `birthday` date DEFAULT NULL,
  `token` varchar(40) NOT NULL DEFAULT '0',
  `newsletter` tinyint(1) NOT NULL DEFAULT '1',
  `userlevel` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastlogin` datetime DEFAULT CURRENT_TIMESTAMP,
  `lastip` varchar(16) DEFAULT '0',
  `avatar` varchar(50) DEFAULT 'blank.jpg',
  `notes` tinytext,
  `active` enum('y','n','t','b') NOT NULL DEFAULT 't',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- INSERTING DATA INTO users
INSERT INTO users VALUES ('5','Hitalo','7c4a8d09ca3762af61e59520943dc26494f8941b','0','2000-01-01 00:00:00','0','hitaloramon@live.com','Hitalo Ramon','Freitas Nicolau','','a999c11fb47902a8aa0d519790f25b5c','1','1','2018-12-21 02:14:40','2019-09-06 23:22:37','127.0.0.1','blank.jpg','','y');
INSERT INTO users VALUES ('11','Everton','161b43b73ba332700ba0a34ef4f3f22513c903c4','0','2000-01-01 00:00:00','0','evertonfreitas16@hotmail.com','Everton','Freitas','','0','1','0','2019-02-12 02:22:41','2019-02-12 02:22:41','0','blank.jpg','','y');
INSERT INTO users VALUES ('19','Adeilton','7c4a8d09ca3762af61e59520943dc26494f8941b','2','2019-06-05 01:21:16','0','adeilton@gmail.com','Adeilton','Nicolau','','0','1','0','2019-02-19 16:07:41','2019-03-07 01:21:26','127.0.0.1','blank.jpg','','y');
INSERT INTO users VALUES ('20','Rogerio','7c4a8d09ca3762af61e59520943dc26494f8941b','2','2019-06-05 01:26:15','1','meupost@gmail.com','Rogerio','Marciel','','0','1','0','2019-03-07 01:26:15','2019-03-07 01:26:15','0','blank.jpg','','y');


-- CREATING TABLE users_address
DROP TABLE IF EXISTS `users_address`;
CREATE TABLE `users_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `street` varchar(255) NOT NULL,
  `number` varchar(20) NOT NULL,
  `complement` varchar(50) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `district` varchar(50) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(20) NOT NULL,
  `country` varchar(50) NOT NULL,
  `phone_code` varchar(2) NOT NULL,
  `phone` varchar(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- INSERTING DATA INTO users_address


-- CREATING TABLE widgets
DROP TABLE IF EXISTS `widgets`;
CREATE TABLE `widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL,
  `body` text,
  `show_title` tinyint(1) NOT NULL DEFAULT '0',
  `show_order` tinyint(1) NOT NULL DEFAULT '0',
  `system` tinyint(1) NOT NULL DEFAULT '0',
  `info` text,
  `widget_alias` varchar(50) DEFAULT NULL,
  `widget_data` varchar(255) NOT NULL DEFAULT '0',
  `module_alias` varchar(50) DEFAULT NULL,
  `hasconfig` tinyint(1) NOT NULL DEFAULT '0',
  `container` int(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- INSERTING DATA INTO widgets
INSERT INTO widgets VALUES ('3','Mídias Sociais','&#60;div id=&#34;iijx&#34; style=&#34;box-sizing: border-box;&#34;&#62;Fique ligado em todas as nossas atualizações.&#60;br data-highlightable=&#34;1&#34; id=&#34;il9u-2&#34; style=&#34;box-sizing: border-box;&#34;&#62;Siga-nos nas redes e mídias sociais.&#38;nbsp;&#60;/div&#62;','1','0','1','Mostra todas as redes sociais configuradas no sistema','social','0','','0','0','2016-10-25 16:31:03','1');
INSERT INTO widgets VALUES ('2','Menu Vertical','','1','0','1','Exibe o Menu do Site na Vertical','menuvertical','0','','0','0','2016-04-15 11:12:14','1');
INSERT INTO widgets VALUES ('1','Login','','1','0','1','Exibe o Formulário de Login','login','0','','0','0','2016-02-11 11:12:15','1');
INSERT INTO widgets VALUES ('15','RSS - teste','','0','0','1','','rss','11','rss','0','0','2019-03-14 16:46:10','1');
INSERT INTO widgets VALUES ('4','Contato','','0','0','1','Mostra um formulário de contato no seu website','contactform','0','','0','0','2019-03-25 15:58:41','1');
INSERT INTO widgets VALUES ('26','Categorias do Blog','','1','0','1','Mostra as Categorias do Blog','blogcategories','0','blog','0','0','2019-04-24 00:46:15','1');
INSERT INTO widgets VALUES ('27','Popular','','1','0','1','Mostra as postagens populares do blog','blogpopular','0','blog','0','0','2019-04-24 00:46:15','1');
INSERT INTO widgets VALUES ('28','Pesquisar no Blog','','0','0','1','Pesquisa por postagens do blog','blogsearch','0','blog','0','0','2019-04-24 00:46:15','1');
INSERT INTO widgets VALUES ('31','Slider - Teste','','0','0','1','','slider','8','slider','0','1','2019-05-14 22:07:50','1');


-- THE END

