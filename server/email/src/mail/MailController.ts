import { MailService } from './MailService'
import { Injectable } from '@nestjs/common'
import { Nack, RabbitSubscribe  } from '@golevelup/nestjs-rabbitmq'

@Injectable()
export class MailController {
  constructor(
    private readonly mailService: MailService
  ) {}

  @RabbitSubscribe({
    exchange: 'email',
    routingKey: 'email',
    queue: 'email'
  })
  async handleMessage(message: any) {
    try {
      this.mailService.execute(message)
    } catch (error) {
      return new Nack()
    }
  }
}

