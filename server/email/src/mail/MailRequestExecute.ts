import { Mail } from "./Mail"
import { MailCodeConfirmation } from "./MailCodeConfirmation"
import { MailWelcome } from "./MailWelcome"

export type MailTypeParams = (data: object,mail: Mail) => void

export const mailWelcomeExecute: MailTypeParams = (data: object, mail: Mail): void => {
  const mailSend = new MailWelcome(mail)
  mailSend.send(data['email'],data['name'])
}

export const mailCodeConfirmationExecute: MailTypeParams = (data: object,mail: Mail): void => {
  const mailSend = new MailCodeConfirmation(mail)
  mailSend.send(data['email'], data['code'])
}

export const MailTypeMap: Record<string, MailTypeParams> = {
  'USER_EMAIL_WELCOME': mailWelcomeExecute,
  'USER_EMAIL_CONFIRMATION_CODE': mailCodeConfirmationExecute
}