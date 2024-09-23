import { RabbitMQModule } from '@golevelup/nestjs-rabbitmq'
import { Module } from '@nestjs/common'
import { ConfigService } from '@nestjs/config'

@Module({
  imports: [
    RabbitMQModule.forRootAsync(RabbitMQModule, {
      inject: [ConfigService],
      useFactory: (config: ConfigService) => ({
        exchanges: [
          {
            name: 'email', 
            type: 'direct', 
          },
        ],
        uri: `amqp://${config.get('RABBITMQ_USER')}:${config.get('RABBITMQ_PASSWORD')}@${config.get('RABBITMQ_HOST')}:${config.get('RABBITMQ_PORT')}/`,
        enableControllerDiscovery: true,
      })    
    })
  ],
})
export class MessageBrokerModule {}
