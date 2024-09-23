import { Module } from '@nestjs/common'
import { MailerModule } from '@nestjs-modules/mailer'
import { MailController } from './MailController'
import { NodeMail } from './NodeMail'
import { MailService } from './MailService'
import { Mail } from './Mail'
import { ConfigService } from '@nestjs/config'

@Module({  
    imports: [ 
        MailerModule.forRootAsync({
          inject: [ConfigService],
          useFactory: (config: ConfigService) => ({
            transport: {
              host: config.get('EMAIL_HOST'),
              port: Number(config.get('EMAIL_PORT')),           
              auth: {
                  user: config.get('EMAIL_USERNAME'),
                  pass: config.get('EMAIL_PASSWORD'),
              },
              secure: false,
            },
          })    
        })
    ],
    controllers: [],
    providers: [
      MailController,
      MailService,
      {
        provide: Mail,
        useClass: NodeMail
      }
    ],
})

export class MailModule{}