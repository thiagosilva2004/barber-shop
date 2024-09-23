export abstract class Mail{
   abstract send(to: string, subject: string, message: string, html?: string):void
}