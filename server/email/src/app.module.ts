import { Module } from '@nestjs/common'
import { MailModule } from './mail/MailModule'
import { MessageBrokerModule } from './messageBroker/MessageBrokerModule'
import { AppConfigModule } from './appConfig/AppConfigModule'

@Module({
  imports: [
   AppConfigModule,
   MailModule,
   MessageBrokerModule
  ],
  controllers: [],
  providers: [],
})
export class AppModule {}
