import { Mail } from "./Mail"

export class MailCodeConfirmation {
    private subject: string = "Email de confirmação"

    constructor(private readonly mail: Mail) {}

    public send(mail_to: string, code_confirmation: string):void {
        const message = "Confirme seu email para realizar o login, código: " + code_confirmation

        this.mail.send(mail_to,this.subject,message,null)
    }
}

