import { MailerService } from '@nestjs-modules/mailer'
import { Injectable } from '@nestjs/common'
import { Mail } from './Mail'

@Injectable()
export class NodeMail implements Mail{
    constructor(private readonly mailService: MailerService) {}

    send(to: string, subject: string, message: string, html: string): void {
        this.mailService.sendMail({
            to: to,
            subject: subject,
            text: message,
            html: html
          }).catch(error => {
            console.log('erro do send: ' + error)
          })
    }
}