<?php
require 'repositorio/PHPMailer-master/PHPMailerAutoload.php';

class Mail
{
    public $email    = '';
    public $usuario  = '';
    public $senha    = '';
    public $servidor = '';
    public $porta    = '';
    public $tls      = '';


    public function __construct($email, $usuario, $senha, $servidor, $porta = '', $tls = '')
    {
        $this->email    = $email;
        $this->usuario  = $usuario;
        $this->senha    = $senha;
        $this->servidor = $servidor;
        $this->porta    = $porta;
        $this->tls      = $tls;
    }


    public function enviaMail($remetente,$destinatario,$assunto,$mensagem,$anexo='',$remetente_nome='',$destinatario_nome='')
    {
        $phpmailer = new PHPMailer;
        $phpmailer->isSMTP();
        $phpmailer->SMTPDebug = 0;
        $phpmailer->Debugoutput = 'html';
        $phpmailer->Host = $this->servidor;
        $phpmailer->Port = (strlen($this->porta)?$this->porta:'587');
        $phpmailer->SMTPSecure = $this->tls;
        $phpmailer->SMTPAuth = true;
        $phpmailer->Username = $this->usuario;
        $phpmailer->Password = $this->senha;
        $phpmailer->setFrom($remetente, $remetente_nome);
        $phpmailer->addReplyTo($remetente, $remetente_nome);
        $phpmailer->addAddress($destinatario, $destinatario);
        $phpmailer->Subject = $assunto;
        $phpmailer->msgHTML($mensagem);

        if(strlen($anexo))
        {
            $phpmailer->addAttachment($anexo);
        }

        return $phpmailer->send();

    }

}

?>
