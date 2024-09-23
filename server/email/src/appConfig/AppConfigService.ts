import { Injectable } from '@nestjs/common';
import { ConfigService } from '@nestjs/config';

@Injectable()
export class AppConfigService {
  constructor(private readonly config: ConfigService) {}

  get emailHost(): string {
    return this.config.get<string>('EMAIL_HOST');
  }

  get emailPort(): number {
    return this.config.get<number>('EMAIL_PORT');
  }

  get emailUsername(): string {
    return this.config.get<string>('EMAIL_USERNAME');
  }

  get emailPassword(): string {
    return this.config.get<string>('EMAIL_PASSWORD');
  }

  get rabbitmqHost(): string {
    return this.config.get<string>('RABBITMQ_HOST');
  }

  get rabbitmqPort(): number {
    return this.config.get<number>('RABBITMQ_PORT');
  }

  get rabbitmqUsername(): string {
    return this.config.get<string>('RABBITMQ_USERNAME');
  }

  get rabbitmqPassword(): string {
    return this.config.get<string>('RABBITMQ_PASSWORD');
  }
}
