import { Mail } from "./Mail"

export class MailWelcome {
    private subject: string = "Email de boas vindas"

    constructor(private readonly mail: Mail) {}

    public send(mail_to: string, user_name: string):void {
        const message = `olá ${user_name}, parabéns por ter se cadastro em nossa barbearia`

        this.mail.send(mail_to,this.subject,message,null)
    }
}

