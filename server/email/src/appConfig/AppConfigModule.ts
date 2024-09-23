import { Module } from '@nestjs/common';
import { ConfigModule } from '@nestjs/config';
import * as Joi from 'joi';
import { AppConfigService } from './AppConfigService';

@Module({
  imports: [
    ConfigModule.forRoot({
      isGlobal: true,
      validationSchema: Joi.object({     
        EMAIL_HOST: Joi.string().required(),
        EMAIL_PORT: Joi.number().port(),
        EMAIL_USERNAME: Joi.string().required(),
        EMAIL_PASSWORD: Joi.string().required(),

        RABBITMQ_HOST:Joi.string().required(),
        RABBITMQ_PORT:Joi.number().port(),
        RABBITMQ_USER:Joi.string().required(),
        RABBITMQ_PASSWORD:Joi.string().required(),
      }),
    }),
  ],
  providers: [AppConfigService],
  exports: [AppConfigService],
})
export class AppConfigModule {}