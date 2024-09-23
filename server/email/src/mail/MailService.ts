import { Injectable } from "@nestjs/common"
import { Mail } from "./Mail"
import { MailTypeMap } from "./MailRequestExecute"

@Injectable()
export class MailService{
    constructor(private readonly mail: Mail) {}

    execute(data: MailRequest){
        const requestExecute = MailTypeMap[data.type]

        if (requestExecute == undefined) {
          throw new Error(`Not found an email send type: "${data.type}".`)
        }
  
        requestExecute(data.data,this.mail)
    }
}